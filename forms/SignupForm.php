<?php
 
namespace app\forms;
 
use himiklab\yii2\recaptcha\ReCaptchaValidator2;
use Yii;
use yii\base\Model;
 
/**
 * Signup form
 */
class SignupForm extends Model
{
 
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $reCaptcha;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Логин бос емес!'],
            ['username', 'string', 'min' => 3, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Бұл email бос емес!'],
            [['password', 'password_repeat'], 'required'],
            ['password', 'validateOwnPassword'],
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Құпия сөздер сәйкес келмейді' ],
            [
                ['reCaptcha'],
                ReCaptchaValidator2::class,
                'uncheckedMessage' => Yii::t('common', 'Растаңыз')
            ],
        ];
    }

    public function validateOwnPassword($attribute, $params)
    {
        if ( !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $this->$attribute) ) {
            $this->addError($attribute, 'Құпия сөз кем дегенде 8 таңбадан, 1 бас әріптен, 1 кіші әріптен, 1 цифрадан және 1 арнайы таңбадан тұруы керек');
        }
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('common', 'Логин'),
            'email' => 'Email',
            'password' => Yii::t('common', 'Құпия сөз'),
            'password_repeat' => Yii::t('common', 'Құпия сөзді растау'),
            'rememberMe' => 'Мені жүйеде сақтау',
            'reCaptcha' => Yii::t('common', 'Робот емес екендігіңізді растаңыз'),
        ];
    }

    public function getData(): array
    {
        return [
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

}