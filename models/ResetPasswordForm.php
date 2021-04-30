<?php
 
namespace app\models;
 
use yii\base\Model;
use yii\base\InvalidParamException;
 
/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
 
    public $password;
    public $password_repeat;
 
    /**
     * @var \app\models\User
     */
    private $_user;
 
    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
 
        if (empty($token) || !is_string($token)) {
            throw new \yii\web\HttpException(404,'Страница не найдена');
        }
 
        $this->_user = UserIdentity::findByPasswordResetToken($token);
 
        if (!$this->_user) {
            throw new \yii\web\HttpException(404,'Страница не найдена');
        }
 
        parent::__construct($config);
    }
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 8],
            ['password', 'validatePrevPassword'],
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Құпия сөздер сәйкес келмейді' ],
        ];
    }

    public function validatePrevPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->_user;
            if ($user->validatePassword($this->password)) {
                $this->addError($attribute, 'Жаңа құпия сөз ескіден өзгеше болуы керек.');
            }
        }
    }
 
    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->password = $this->password;
        $user->email_confirm_token = null;
        $user->status = UserIdentity::STATUS_ACTIVE;
        $user->removePasswordResetToken();
        return $user->save(false);
    }
 
}