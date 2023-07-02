<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "section_examples".
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property bool $is_optional
 *
 * @property Field[] $fields
 */
class Section extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'sections';
    }

    public function rules(): array
    {
        return [
            [['name', 'slug', 'is_optional'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['is_optional'], 'boolean'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'name' => Yii::t('common', 'Аты'),
        ];
    }

    public function getFields(): ActiveQuery
    {
        return $this->hasMany(Field::class, ['section_id' => 'id']);
    }
}
