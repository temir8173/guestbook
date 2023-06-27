<?php

namespace app\forms;

use app\models\User;
use app\models\UserIdentity;
use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private ?User $_user = null;


    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('common', 'Логин немесе email'),
            'password' => Yii::t('common', 'Құпия сөз'),
            'rememberMe' => 'Мені жүйеде сақтау',
        ];
    }

    public function validatePassword(string $attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('common', 'Құпия сөз дұрыс емес немесе бұндай пайдаланушы тіркелмеген'));
            }
        }
    }

    public function getUser(): ?UserIdentity
    {
        $this->_user ??= UserIdentity::findByUsername($this->username);
        return $this->_user;
    }
}
