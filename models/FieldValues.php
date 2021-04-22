<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "field_values".
 *
 * @property int $id
 * @property int $section_id
 * @property int $field_id
 * @property string $value
 */
class FieldValues extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFiles;

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
            [['section_id', 'field_id', 'value'], 'required'],
            [['section_id', 'field_id'], 'integer'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'section_id' => 'Секция',
            'field_id' => 'Өріс',
            'value' => 'Өріс мәні',
            'url' => 'Өріс url',
        ];
    }

    public function getField()
    {
        return $this->hasOne(Fields::className(), ['id' => 'field_id']);
    }
}
