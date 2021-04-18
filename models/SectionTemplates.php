<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "section_examples".
 *
 * @property int $id
 * @property string $name
 */
class SectionTemplates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'section_templates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'view'], 'required'],
            [['name', 'view'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'view' => 'Вид',
            'name' => 'Name',
        ];
    }

    public function getFields()
    {
        return $this->hasMany(Fields::className(), ['section_template_id' => 'id']);
    }

    public function getSections()
    {
        return $this->hasMany(Sections::className(), ['section_template_id' => 'id']);
    }
}
