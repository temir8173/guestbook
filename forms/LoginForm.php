<?php

namespace app\forms;

use app\models\User;
use app\models\UserIdentity;
use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $phoneOrEmail;
    public $passwordOrCode;
    public $rememberMe = true;

    private ?User $_user = null;


    public function rules(): array
    {
        return [
            [['phoneOrEmail', 'passwordOrCode'], 'required'],
            ['rememberMe', 'boolean'],
            ['passwordOrCode', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'phoneOrEmail' => Yii::t('common', 'Телефон нөмірі немесе email'),
            'passwordOrCode' => Yii::t('common', 'Құпия сөз немесе смс-код'),
            'rememberMe' => 'Мені жүйеде сақтау',
        ];
    }

    public function validatePassword(string $attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (
                !$user || (
                    !$user->validatePassword($this->passwordOrCode)
                    && !$user->validateCode($this->passwordOrCode)
                )
            ) {
                $this->addError($attribute, Yii::t('common', 'Құпия сөз дұрыс емес немесе мұндай пайдаланушы тіркелмеген'));
            }
        }
    }

    public function getUser(): ?UserIdentity
    {
        $this->_user ??= UserIdentity::findByPhoneOrEmail($this->phoneOrEmail);
        return $this->_user;
    }
}
