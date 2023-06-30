<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;

class UserIdentity extends User implements IdentityInterface
{
    public static function findIdentity($id): UserIdentity|IdentityInterface|null
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): UserIdentity|IdentityInterface|null
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByUsername(string $username): ActiveRecord|self|null
    {
        return static::find()
            ->where(new Expression('BINARY `username` = :value', [':value' => $username]))
            ->orWhere(new Expression('BINARY `email` = :value', [':value' => $username]))
            ->andWhere(['>', 'status', self::STATUS_DELETED])
            ->one();
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword(string $password): bool
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
}
