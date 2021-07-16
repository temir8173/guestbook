<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class UserIdentity extends User implements \yii\web\IdentityInterface
{



    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return array|ActiveRecord|null
     */
    public static function findByUsername($username)
    {

        return static::find()
        ->where(['username' => $username])
        ->orWhere(['email' => $username])
        ->andWhere(['>', 'status', self::STATUS_DELETED])
        ->one();

    }

    /**
     * {@inheritdoc}
     * @return bool
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword(string $password): bool
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
}
