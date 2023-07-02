<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string $preview_img
 * @property array $sections
 * @property int $price
 * @property int $discount_price
 * @property string $type
*/
class Template extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'templates';
    }

    public function rules(): array
    {
        return [
            [['slug', 'name', 'preview_img', 'price', 'discount_price', 'sections'], 'required'],
            [['price', 'discount_price'], 'integer'],
            [['slug', 'name'], 'string', 'max' => 64],
            [['preview_img'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    public function save($runValidation = true, $attributeNames = null): bool
    {
        $previewImageFiles = UploadedFile::getInstancesByName('Template[preview_img]');
        $previewImageFile = $previewImageFiles[0] ?? null;
        if ($previewImageFile) {
            $name = 'preview_' . $this->slug
                . '_' . preg_replace("/\s+/", "_", $previewImageFile->baseName)
                . '.' . $previewImageFile->extension;
            $previewImageFile->saveAs('uploads/template_previews/' . $name);
            $this->preview_img = $name;
        }

        return parent::save($runValidation, $attributeNames);
    }
}
