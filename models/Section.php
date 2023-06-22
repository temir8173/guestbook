<?php

namespace app\models;

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
            [['name', 'view'], 'required'],
            [['name', 'view'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'view' => 'Вид',
            'name' => 'Name',
        ];
    }

    public function getFields(): ActiveQuery
    {
        return $this->hasMany(Field::class, ['section_id' => 'id']);
    }
}
