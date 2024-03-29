<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $user_id
 * @property int $invitation_id
 * @property int $price
 * @property string $created_at
 * @property string|null $paid_time
 * @property int $status
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'invitation_id', 'price', 'status'], 'required'],
            [['user_id', 'invitation_id', 'price', 'status'], 'integer'],
            [['paid_time'], 'string'],
            [['is_paid'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'invitation_id' => 'Invitation ID',
            'price' => 'Price',
            'created_at' => 'Create Time',
            'paid_time' => 'Paid Time',
            'status' => 'Status',
            'is_paid' => 'IsPaid?',
        ];
    }
}
