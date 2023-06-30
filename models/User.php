<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

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
 * @property string $email_confirm_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends ActiveRecord
{
    public const ROLE_USER = 'user';
    public const ROLE_ADMIN = 'admin';

    public const STATUS_DELETED = 0;
    public const STATUS_WAIT = 5;
    public const STATUS_ACTIVE = 10;

    public array $roles;
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'user';
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

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get user roles from RBAC
     * @return array
     */
    public function getRoles(): array
    {
        $roles = Yii::$app->authManager->getRolesByUser($this->getId());
        return ArrayHelper::getColumn($roles, 'name', false);
    }
    
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function getAuthKey(): ?string
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

    public static function findByPasswordResetToken($token): UserIdentity|ActiveRecord|null
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return UserIdentity::find()
        ->where(['password_reset_token' => $token])
        ->andWhere(['>', 'status', self::STATUS_DELETED])
        ->one();
    }
     
    public static function isPasswordResetTokenValid($token): bool
    {
        if (empty($token)) {
            return false;
        }
     
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @throws Exception
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
}
