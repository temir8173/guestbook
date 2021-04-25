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

    public $types = [
        'text' => 'Текст',
        'textarea' => 'Область текста',
        'image' => 'Сурет',
        'link' => 'Cілтеме',
        'youtube' => 'Youtube сілтемесі',
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
