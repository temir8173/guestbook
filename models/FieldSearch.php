<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Field;

/**
 * FieldsSearch represents the model behind the search form of `app\models\Fields`.
 */
class FieldSearch extends Field
{
    public function rules(): array
    {
        return [
            [['id', 'section_id'], 'integer'],
            [['name', 'type', 'slug'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Field::find();

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'section_id' => $this->section_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
