<?php

namespace app\components;
 
use app\models\User;
use yii\base\InvalidConfigException;
use yii\rbac\Assignment;
use yii\rbac\PhpManager;
use Yii;
use yii\web\IdentityInterface;

class AuthManager extends PhpManager
{
    /**
     * @throws InvalidConfigException
     */
    public function getAssignments($userId): array
    {
        if ($userId && $user = $this->getUser($userId)) {
            $assignment = new Assignment();
            $assignment->userId = $userId;
            $assignment->roleName = $user->role;
            return [$assignment->roleName => $assignment];
        }
        return [];
    }

    /**
     * @throws InvalidConfigException
     */
    public function getAssignment($roleName, $userId): ?Assignment
    {
        if ($userId && $user = $this->getUser($userId)) {
            if ($user->role === $roleName) {
                $assignment = new Assignment();
                $assignment->userId = $userId;
                $assignment->roleName = $user->role;
                return $assignment;
            }
        }
        return null;
    }
 
    public function getUserIdsByRole($roleName): array
    {
        return User::find()->where(['role' => $roleName])->select('id')->column();
    }
 
    public function assign($role, $userId): ?Assignment
    {
        if ($userId && $user = $this->getUser($userId)) {
            $assignment = new Assignment([
                'userId' => $userId,
                'roleName' => $role->name,
                'createdAt' => time(),
            ]);
            $this->setRole($user, $role->name);
            return $assignment;
        }
        return null;
    }

    /**
     * @throws InvalidConfigException
     */
    public function revoke($role, $userId): bool
    {
        if ($userId && $user = $this->getUser($userId)) {
            if ($user->role === $role->name) {
                $this->setRole($user, null);
                return true;
            }
        }
        return false;
    }

    /**
     * @throws InvalidConfigException
     */
    public function revokeAll($userId): bool
    {
        if ($userId && $user = $this->getUser($userId)) {
            $this->setRole($user, null);
            return true;
        }
        return false;
    }

    /**
     * @param integer $userId
     * @return null|IdentityInterface|User
     * @throws InvalidConfigException
     */
    private function getUser(int $userId)
    {
        $webUser = Yii::$app->get('user', false);
        if ($webUser && !$webUser->getIsGuest() && $webUser->getId() === $userId) {
            return $webUser->getIdentity();
        }

        return User::findOne($userId);
    }
 
    /**
     * @param User $user
     * @param ?string $roleName
     */
    private function setRole(User $user, ?string $roleName): void
    {
        $user->role = $roleName;
        $user->updateAttributes(['role' => $roleName]);
    }
}