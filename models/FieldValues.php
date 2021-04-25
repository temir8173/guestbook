<?php

namespace app\models;

use Yii;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use app\components\Helper;

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
        $newImagesNames = $imagesUpload->upload();
        $this->value = Json::htmlEncode(ArrayHelper::merge($this->ImagesNames, $newImagesNames));
    }

    public function getImagesNames()
    {
        if (Helper::isJson($this->value)) {
            return Json::decode($this->value);
        }
        else {
            return [];
        }
    }

    public function deleteImage($index)
    {
        $imagesNames = $this->imagesNames;
        if (file_exists(Yii::getAlias('@webroot')."/uploads/".$imagesNames[$index]))
            unlink(Yii::getAlias('@webroot')."/uploads/".$imagesNames[$index]);
        array_splice($imagesNames, $index, 1);
        $this->value = Json::htmlEncode($imagesNames);
        $this->save();
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            foreach ($this->imagesNames as $imagesName) {
                if (file_exists(Yii::getAlias('@webroot')."/uploads/".$imagesName))
                    unlink(Yii::getAlias('@webroot')."/uploads/".$imagesName);
            }
            return true;
        } else {
            return false;
        }
    }
}
