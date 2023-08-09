<?php


namespace app\models;


use yii\data\ActiveDataProvider;

class AudioSearch extends Audio
{
    public function rules(): array
    {
        return [
            [['type'], 'string', 'max' => 32],
            [['path', 'name'], 'string', 'max' => 255],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = self::find();

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
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->path]);

        return $dataProvider;
    }
}