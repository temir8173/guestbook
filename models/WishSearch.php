<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Wish;

/**
 * MessagesSearch represents the model behind the search form of `app\models\Messages`.
 */
class WishSearch extends Wish
{
    public function rules(): array
    {
        return [
            [['id', 'created_at', 'invitation_id'], 'integer'],
            [['name', 'text'], 'safe'],
        ];
    }

    public function search(array $params, int $invitation_id = 0): ActiveDataProvider
    {
        $query = Wish::find();

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
            'created_at' => $this->created_at,
            'invitation_id' => ($invitation_id === 0) ? $this->invitation_id : $invitation_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
