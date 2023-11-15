<?php
 
namespace app\forms;
 
use app\models\User;
use app\models\UserIdentity;
use Yii;
use yii\base\Model;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $password_repeat;

    /**
     * @var User
     */
    private User $_user;

    public function __construct(User $user, $config = [])
    {
        $this->_user = $user;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['password', 'required'],
            ['password', 'validatePrevPassword'],
//            [
//                'password',
//                'match',
//                'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
//                'message' => Yii::t(
//                    'common',
//                    'Құпия сөз кем дегенде 8 таңбадан, 1 бас әріптен, 1 кіші әріптен, 1 цифрадан және 1 арнайы таңбадан тұруы керек.(әріптер латын қарпімен)'
//                )
//            ],
            ['password_repeat', 'required'],
            [
                'password_repeat',
                'compare',
                'compareAttribute' => 'password',
                'message' => Yii::t('common', 'Құпия сөздер сәйкес келмейді')
            ],
        ];
    }

    public function validatePrevPassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->_user;
            if ($user->validatePassword($this->password)) {
                $this->addError(
                    $attribute,
                    Yii::t('common', 'Жаңа құпия сөз ескіден өзгеше болуы керек.')
                );
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'password' => Yii::t('common', 'Құпия сөз'),
            'password_repeat' => Yii::t('common', 'Құпия сөзді растау'),
        ];
    }
}
