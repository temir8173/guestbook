<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property int $date
 * @property int $invitation_id
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
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
            'name' => 'Атыңыз',
            'text' => 'Сообщение',
            'date' => 'Дата',
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

    public function getInvitation()
    {
        return $this->hasOne(Invitations::className(), ['id' => 'invitation_id']);
    }
}
