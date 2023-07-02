<?php


namespace app\models;


use yii\data\ActiveDataProvider;

class TemplateSearch extends Template
{
    public function rules(): array
    {
        return [
            [['id', 'price', 'discount_price'], 'integer'],
            [['slug', 'name', 'preview_img', 'sections', 'type'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Template::find();

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
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'text', $this->slug]);

        return $dataProvider;
    }
}