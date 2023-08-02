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
 * @property string $name_rus
 * @property bool $is_optional
 *
 * @property Field[] $fields
 * @property string $localeName
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
            [['name', 'name_rus', 'slug'], 'string', 'max' => 255],
            [['is_optional'], 'boolean'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'name' => Yii::t('common', 'Аты'),
            'name_rus' => Yii::t('common', 'Орысша атауы'),
        ];
    }

    public function getFields(): ActiveQuery
    {
        return $this->hasMany(Field::class, ['section_id' => 'id']);
    }

    public function getLocaleName(): string
    {
        return (\Yii::$app->language = 'ru') && $this->name_rus ? $this->name_rus : $this->name;
    }
}
