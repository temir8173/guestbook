<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ImagesUploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
        ];
    }
    
    public function upload()
    {
        if ($this->validate() && count($this->imageFiles) < 10) {
            $names = [];
            foreach ($this->imageFiles as $file) {
                $name = preg_replace("/\s+/", "", $file->baseName) . time() . '.' . $file->extension;
                $file->saveAs('uploads/' . $name);
                $names[] = $name;
            }
            return $names;
        } else {
            return false;
        }
    }
}