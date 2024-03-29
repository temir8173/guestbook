<?php

namespace app\models;

use himiklab\yii2\recaptcha\ReCaptchaValidator2;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property string $answer
 * @property string $created_at
 * @property int $invitation_id
 *
 * @property Invitation $invitation
 */
class Wish extends ActiveRecord
{
    public $reCaptcha;

    public static function tableName(): string
    {
        return 'wishes';
    }

    public function rules(): array
    {
        return [
            [['name', 'text', 'invitation_id'], 'required'],
            [['text', 'answer'], 'string'],
            ['invitation_id', 'integer'],
            [['name'], 'string', 'max' => 255],
            [
                ['reCaptcha'],
                ReCaptchaValidator2::class,
                'message' => Yii::t('common', 'Робот емес екендігіңізді растаңыз')
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('common', 'Тілек білдіруші'),
            'text' => Yii::t('common', 'Мәтіні'),
            'answer' => Yii::t('common', 'Жауабы (келеді ме?)'),
            'created_at' => Yii::t('common', 'Уақыты'),
            'invitation_id' => Yii::t('common', 'Шақыру билеті'),
        ];
    }

    public function getInvitation(): ActiveQuery
    {
        return $this->hasOne(Invitation::class, ['id' => 'invitation_id']);
    }
}
