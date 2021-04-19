<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "invitations".
 *
 * @property int $id
 * @property string $url
 * @property string $name
 * @property string $template
 * @property int $event_date
 * @property int $created_date
 * @property int $updated_date
 * @property int $status
 */
class Invitations extends ActiveRecord
{
    public $templates = [
        'template1' => 'template1', 
        'template2' => 'template2'
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invitations';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_date',
                'updatedAtAttribute' => 'updated_date',
                'value' => time(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'name', 'template', 'event_date', 'status'], 'required'],
            [['status'], 'integer'],
            [['url', 'name', 'template'], 'string', 'max' => 255],
            [['url'], 'unique'],
            [['status'], 'default', 'value'=> 0],
            [['created_date'], 'default', 'value'=> time()],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'name' => 'Name',
            'event_date' => 'Event Date',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'status' => 'Status',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->event_date = Yii::$app->formatter->asTimestamp($this->event_date);
            return true;
        }
        return false;
    }

    public function getSections()
    {
        return $this->hasMany(Sections::className(), ['invitation_id' => 'id']);
    }

}
