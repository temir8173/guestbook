<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sections".
 *
 * @property int $id
 * @property int $invitation_id
 * @property int $order
 * @property int $section_template_id
 * @property int $status
 */
class Sections extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sections';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['invitation_id', 'order', 'section_template_id', 'status'], 'required'],
            [['invitation_id', 'order', 'section_template_id', 'status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invitation_id' => 'Invitation ID',
            'order' => 'Реті',
            'section_template_id' => 'Section Example ID',
            'status' => 'Белсенді',
        ];
    }

    public function getSectionTemplate()
    {
        return $this->hasOne(SectionTemplates::className(), ['id' => 'section_template_id']);
    }

    public function getFieldValues()
    {
        return $this->hasMany(FieldValues::className(), ['section_id' => 'id']);
    }

    public function getFieldValueByUrl($url)
    {
        return FieldValues::find()
        ->joinWith('field f')
        ->where(['section_id' => $this->id])
        ->andWhere(['f.url' => $url])
        ->one()
        ->value;
    }
}
