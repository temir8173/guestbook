<?php
 
namespace app\forms;
 
use app\models\User;
use app\models\UserIdentity;
use himiklab\yii2\recaptcha\ReCaptchaValidator2;
use Yii;
use yii\base\Model;
 
/**
 * Password reset request form
 */
class RecoverRequestForm extends Model
{
    public $email;
    public $reCaptcha;

    private ?User $_user = null;

    public function rules(): array
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'validateUserExist'],
            [
                ['reCaptcha'],
                ReCaptchaValidator2::class,
                'uncheckedMessage' => Yii::t('common', 'Растаңыз')
            ],
        ];
    }

    public function validateUserExist($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user) {
                $this->addError($attribute, 'Бұндай пайдаланушы тіркелмеген.');
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'email' => Yii::t('common', 'Логин немесе email'),
            'reCaptcha' => Yii::t('common', 'Робот емес екендігіңізді растаңыз'),
        ];
    }

    public function getUser(): ?UserIdentity
    {
        $this->_user ??= UserIdentity::findByUsername($this->email);
        return $this->_user;
    }
}
