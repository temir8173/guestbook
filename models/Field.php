<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "fields".
 *
 * @property int $id
 * @property string $name
 * @property string $name_rus
 * @property int $section_id
 * @property string $type
 * @property string $slug
 * @property string $hint
 * @property string $default_value
 *
 * @property Section $section
 * @property string $localeName
 */
class Field extends ActiveRecord
{

    const TYPE_TEXT = 'text';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_IMAGE = 'image';
    const TYPE_LINK = 'link';
    const TYPE_YOUTUBE = 'youtube';
    const TYPE_MAP = 'map';
    const TYPE_CLOUD_LINK = 'cloudLink';
    const JSON = 'json';

    public array $types = [
        self::TYPE_TEXT => 'Текст',
        self::TYPE_TEXTAREA => 'Область текста',
        self::TYPE_IMAGE => 'Сурет',
        self::TYPE_LINK => 'Cілтеме',
        self::TYPE_YOUTUBE => 'Youtube сілтемесі',
        self::TYPE_MAP => 'Карта 2gis',
        self::TYPE_CLOUD_LINK => 'Бұлтты сервиске сілтеме',
        self::JSON => 'json(массив, объект)',
    ];

    public static function tableName(): string
    {
        return 'fields';
    }

    public function rules(): array
    {
        return [
            [['name', 'section_id', 'type', 'slug'], 'required'],
            [['section_id'], 'integer'],
            [['name', 'name_rus', 'type', 'slug'], 'string', 'max' => 255],
            [['hint', 'default_value'], 'string'],
            [['slug'], 'unique'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Аты',
            'name_rus' => 'Орысша атауы',
            'section_id' => 'Секция',
            'type' => 'Түрі',
            'hint' => 'Подсказка',
            'default_value' => 'По умолчанию',
        ];
    }

    public function getSection(): ActiveQuery
    {
        return $this->hasOne(Section::class, ['id' => 'section_id']);
    }

    public function getLocaleName(): string
    {
        return (\Yii::$app->language === 'ru') && $this->name_rus ? $this->name_rus : $this->name;
    }
}
