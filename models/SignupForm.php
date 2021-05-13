<?php
 
namespace app\models;
 
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
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Бұндай ат бос емес!'],
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
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::className(),
            //'secret' => 'your secret key', // unnecessary if reСaptcha is already configured
            'uncheckedMessage' => Yii::t('common', 'Растаңыз')],
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
 
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
 
        if (!$this->validate()) {
            return null;
        }
 
        $user = new UserIdentity();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = $this->password;
        $user->role = 'user';
        $user->generateAuthKey();
        $user->email_confirm_token = Yii::$app->security->generateRandomString();
        $user->status = UserIdentity::STATUS_WAIT;
        //return $user->save() ? $user : null;
        if(!$user->save()){
            throw new \RuntimeException('Saving error.');
        }

        $this->sentEmailConfirm($user);
    }

    public function sentEmailConfirm(UserIdentity $user)
    {
        $email = $user->email;

        $sent = Yii::$app->mailer
            ->compose(
                ['html' => 'user-signup-comfirm-html', 'text' => 'user-signup-comfirm-text'],
                ['user' => $user])
            ->setTo($email)
            ->setFrom(Yii::$app->params['senderEmail'])
            ->setSubject('Confirmation of registration')
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }
    }


    public function confirmation($t): void
    {
        if (empty($t)) {
            throw new \DomainException('Empty confirm token.');
        }

        $user = UserIdentity::findOne(['email_confirm_token' => $t]);
        if (!$user) {
            throw new \DomainException('User is not found.');
        }

        $user->email_confirm_token = null;
        $user->status = UserIdentity::STATUS_ACTIVE;
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }

        if (!Yii::$app->getUser()->login($user)){
            throw new \RuntimeException('Error authentication.');
        }
    }
 
}