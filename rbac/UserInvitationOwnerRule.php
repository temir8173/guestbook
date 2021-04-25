<?php
namespace app\rbac;
 
use yii\rbac\Rule;
use yii\rbac\Item;
use app\models\Invitations;
 
class UserInvitationOwnerRule extends Rule
{
    public $name = 'isInvitationOwner';
 
    /**
     * @param string|integer $user   the user ID.
     * @param Item           $item   the role or permission that this rule is associated with
     * @param array          $params parameters passed to ManagerInterface::checkAccess().
     *
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        $role = \Yii::$app->user->identity->role;
        if ($role == 'admin') {
            return true;
        }

        if (isset($params['invitationId']))
            $invitation = Invitations::findOne($params['invitationId']);
        
        return ( isset($params['invitationId']) && isset($invitation) ) ? \Yii::$app->user->id == $invitation->user_id : false;
    }
}