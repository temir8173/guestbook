<?php

namespace app\models;

use Yii;
use yii\helpers\Json;

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

    public function uploadImages()
    {
        $imagesUpload = new ImagesUploadForm();
        $imagesUpload->imageFiles = $this->imageFiles;
        $this->value = Json::encode($imagesUpload->upload());
    }

    public function getImagesNames()
    {
        if ($this->field->type == 'image') {
            return Json::decode($this->value);
        }
        else {
            return false;
        }
    }
}
