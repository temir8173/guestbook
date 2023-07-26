<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Invitation;

/**
 * InvitationsSearch represents the model behind the search form of `app\models\Invitations`.
 */
class InvitationSearch extends Invitation
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'event_date', 'status', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'date'],
            [['url', 'name', 'is_demo', 'is_deleted'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search(array $params, ?int $userId = null): ActiveDataProvider
    {
        $query = Invitation::find();

        if ($userId) {
            $query
                ->where(['user_id' => $userId])
                ->andWhere(['is_deleted' => false])
                ->with('user');
        }

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
            'event_date' => $this->event_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $userId ?? $this->user_id,
            'status' => $this->status,
            'is_demo' => $this->is_demo,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
