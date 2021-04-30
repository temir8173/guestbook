<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $role
 * @property string|null $auth_key
 * @property string|null $access_token
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    const STATUS_DELETED = 0;
    const STATUS_WAIT = 5;
    const STATUS_ACTIVE = 10;

    public $roles;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['roles'], 'safe'],
            [['username', 'password'], 'required'],
            [['username', 'password', 'auth_key', 'access_token'], 'string', 'max' => 255],
            [['role'], 'string', 'max' => 64],
            [['username'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_WAIT, self::STATUS_DELETED]],
        ];
    }

    public function __construct()
    {
        //$this->on(self::EVENT_AFTER_UPDATE, [$this, 'saveRoles']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя',
            'password' => 'Пароль',
            'role' => 'Роль',
            'roles' => 'Роли',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
        ];
    }

    /**
     * Populate roles attribute with data from RBAC after record loaded from DB 
     */
    public function afterFind()
    {
        //$this->roles = $this->getRoles();
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->password !== $this->getOldAttribute('password')) {
                $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password, 12);
            }
            return true;
        }
        return false;
    }
    
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        //$this->saveRoles();
    }

    /**
     * Revoke old roles and assign new if any
     */
    public function saveRoles()
    {
        Yii::$app->authManager->revokeAll($this->getId());

        if (is_array($this->roles)) {
            foreach ($this->roles as $roleName) {
                if ($role = Yii::$app->authManager->getRole($roleName)) {
                    Yii::$app->authManager->assign($role, $this->getId());
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get user roles from RBAC
     * @return array
     */
    public function getRoles()
    {
        $roles = Yii::$app->authManager->getRolesByUser($this->getId());
        return ArrayHelper::getColumn($roles, 'name', false);
    }
    
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }


    public function getRolesDropdown()
    {
        return [
            self::ROLE_ADMIN => 'Админ',
            self::ROLE_USER => 'Пользователь',
        ];
    }

    public static function findByPasswordResetToken($token)
    {
     
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        
        return static::find()
        ->where(['password_reset_token' => $token])
        ->andWhere(['>', 'status', self::STATUS_DELETED])
        ->one();
    }
     
    public static function isPasswordResetTokenValid($token)
    {
     
        if (empty($token)) {
            return false;
        }
     
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
 
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
 
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
