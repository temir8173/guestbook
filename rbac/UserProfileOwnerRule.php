<?php
namespace app\rbac;
 
use app\models\User;
use Yii;
use yii\rbac\Rule;
use yii\rbac\Item;
 
class UserProfileOwnerRule extends Rule
{
    public $name = 'isProfileOwner';
 
    /**
     * @param string|integer $user   the user ID.
     * @param Item           $item   the role or permission that this rule is associated with
     * @param array          $params parameters passed to ManagerInterface::checkAccess().
     *
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params): bool
    {
        $role = Yii::$app->user->identity->role;
        if ($role === User::ROLE_ADMIN) {
            return true;
        }
        
        return isset($params['profileId']) && Yii::$app->user->id === (int)$params['profileId'];
    }
}