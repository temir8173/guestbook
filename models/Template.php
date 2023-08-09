<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string $preview_img
 * @property string $previewImage
 * @property array $sections
 * @property int $price
 * @property int $discount_price
 * @property string $type
*/
class Template extends ActiveRecord
{
    public const PREVIEW_IMAGE_PATH = '/uploads/template_previews/';
    public const PREVIEW_IMAGE_REL_PATH = 'uploads/template_previews/';

    public static function tableName(): string
    {
        return 'templates';
    }

    public function rules(): array
    {
        return [
            [['slug', 'name', 'price', 'sections'], 'required'],
            [['price', 'discount_price'], 'integer'],
            [['slug', 'name'], 'string', 'max' => 64],
            [['preview_img'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['preview_img'], 'safe'],
        ];
    }

    public function getPreviewImage(): string
    {
        return self::PREVIEW_IMAGE_PATH . $this->preview_img;
    }

    public function save($runValidation = true, $attributeNames = null): bool
    {
        $previewImageFiles = UploadedFile::getInstancesByName('Template[preview_img]');
        $previewImageFile = $previewImageFiles[0] ?? null;
        $name = null;
        if ($previewImageFile) {
            $name = 'preview_' . $this->slug
                . '_' . preg_replace("/\s+/", "_", $previewImageFile->baseName)
                . '.' . $previewImageFile->extension;
            $previewImageFile->saveAs(self::PREVIEW_IMAGE_REL_PATH . $name);
        }
        $this->preview_img = $name ?? $this->oldAttributes['preview_img'] ?? '';

        return parent::save($runValidation, $attributeNames);
    }
}
