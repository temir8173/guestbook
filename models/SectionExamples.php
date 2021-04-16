<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "section_examples".
 *
 * @property int $id
 * @property string $name
 */
class SectionExamples extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'section_examples';
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
}
