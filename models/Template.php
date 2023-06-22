<?php


namespace app\models;


use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string $preview_img
 * @property array $sections
 * @property int $price
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
            [['slug', 'name', 'preview'], 'required'],
            [['slug', 'name'], 'string', 'max' => 64],
            [['preview'], 'string', 'max' => 255],
        ];
    }
}
