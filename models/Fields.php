<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fields".
 *
 * @property int $id
 * @property string $name
 * @property int $section_example_id
 * @property string $type
 */
class Fields extends \yii\db\ActiveRecord
{

    const TYPE_TEXT = 'text';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_IMAGE = 'image';
    const TYPE_LINK = 'link';
    const TYPE_YOUTUBE = 'youtube';
    const TYPE_MAP = 'map';

    public $types = [
        self::TYPE_TEXT => 'Текст',
        self::TYPE_TEXTAREA => 'Область текста',
        self::TYPE_IMAGE => 'Сурет',
        self::TYPE_LINK => 'Cілтеме',
        self::TYPE_YOUTUBE => 'Youtube сілтемесі',
        self::TYPE_MAP => 'Карта 2gis',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fields';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'section_template_id', 'type', 'url'], 'required'],
            [['section_template_id'], 'integer'],
            [['name', 'type', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Аты',
            'section_template_id' => 'Секция',
            'type' => 'Түрі',
        ];
    }

    public function getSectionTemplate()
    {
        return $this->hasOne(SectionTemplates::className(), ['id' => 'section_template_id']);
    }
}
