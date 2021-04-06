<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "field_values".
 *
 * @property int $id
 * @property int $invitation_id
 * @property int $field_id
 * @property string $value
 */
class FieldValues extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'field_values';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['invitation_id', 'field_id', 'value'], 'required'],
            [['invitation_id', 'field_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invitation_id' => 'Invitation ID',
            'field_id' => 'Field ID',
            'value' => 'Value',
        ];
    }
}
