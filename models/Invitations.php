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
 * @property int $user_id
 */
class Invitations extends ActiveRecord
{

    const STATUS_UNPAID = 0;
    const STATUS_PAID = 1;

    const TEMPLATE_1 = 'template1';
    const TEMPLATE_2 = 'template2';
    const TEMPLATE_RUSLAN = 'template-ruslan';

    public static function getTemplates()
    {
        return [
            self::TEMPLATE_1 => 'template1', 
            self::TEMPLATE_2 => 'template2',
            self::TEMPLATE_RUSLAN => 'Шаблон - Руслан',
        ];
    }

    public static function getStatusLabels()
    {
        return [
            self::STATUS_UNPAID => 'Төленбеген',
            self::STATUS_PAID => 'Төленген',
        ];
    }

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
            [['url', 'name', 'template', 'event_date', 'status', 'user_id'], 'required'],
            [['status', 'user_id'], 'integer'],
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
            'name' => Yii::t('common', 'Аты'),
            'event_date' => Yii::t('common', 'Өткізілетін уақыты'),
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'template' => 'Шаблон',
            'status' => Yii::t('common', 'Төлем'),
            'user_id' => Yii::t('common', 'Пайдаланушы'),
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

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            foreach ($this->sections as $section) {
                $section->delete();
            }
            foreach ($this->messages as $message) {
                $message->delete();
            }
            return true;
        } else {
            return false;
        }
    }

    public function getSections()
    {
        return $this->hasMany(Sections::className(), ['invitation_id' => 'id']);
    }

    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['invitation_id' => 'id']);
    }

}
