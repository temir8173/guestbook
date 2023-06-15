<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property int $date
 * @property int $invitation_id
 */
class Wish extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wishes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'text', 'invitation_id'], 'required'],
            [['text'], 'string'],
            ['invitation_id', 'integer'],
            [['name'], 'string', 'max' => 255],
            ['date', 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('common', 'Тілек білдіруші'),
            'text' => Yii::t('common', 'Мәтіні'),
            'date' => Yii::t('common', 'Уақыты'),
            'invitation_id' => 'invitation_id',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) $this->date = time();
            return true;
        }
        return false;
    }

    public function getInvitation(): ActiveQuery
    {
        return $this->hasOne(Invitation::class, ['id' => 'invitation_id']);
    }
}
