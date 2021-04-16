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
            [['name', 'section_example_id', 'type'], 'required'],
            [['section_example_id'], 'integer'],
            [['name', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'section_example_id' => 'Section Example ID',
            'type' => 'Type',
        ];
    }
}
