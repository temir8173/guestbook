<?php
namespace app\commands;
 
use Exception;
use yii\base\Exception as BaseException;
use Yii;
use yii\console\Controller;
use app\rbac\UserProfileOwnerRule;
use app\rbac\UserInvitationOwnerRule;
use app\modules\admin\rbac\Rbac as AdminRbac;
 
class RbacController extends Controller
{
    /**
     * @throws BaseException
     * @throws Exception
     */
    public function actionInit()
    {
        $auth = Yii::$app->getAuthManager();
        $auth->removeAll();
 
        $adminPanel = $auth->createPermission(AdminRbac::PERMISSION_ADMIN_PANEL);
        $adminPanel->description = 'Admin panel';
        $auth->add($adminPanel);

        $userProfileOwnerRule = new UserProfileOwnerRule();
        $auth->add($userProfileOwnerRule);
         
        $updateOwnProfile = $auth->createPermission('updateOwnProfile');
        $updateOwnProfile->ruleName = $userProfileOwnerRule->name;
        $auth->add($updateOwnProfile);

        $userInvitationOwnerRule = new UserInvitationOwnerRule();
        $auth->add($userInvitationOwnerRule);
         
        $manageInvitation = $auth->createPermission('manageInvitation');
        $manageInvitation->ruleName = $userInvitationOwnerRule->name;
        $auth->add($manageInvitation);
 
        $user = $auth->createRole('user');
        $user->description = 'User';
        $auth->add($user);
 
        $admin = $auth->createRole('admin');
        $admin->description = 'Admin';
        $auth->add($admin);
         
        $auth->addChild($user, $updateOwnProfile);
        $auth->addChild($user, $manageInvitation);
        $auth->addChild($admin, $user);
        $auth->addChild($admin, $adminPanel);
        
        $this->stdout('Done! Data has been successfully created' . PHP_EOL);
    }
    public function actionRemove()
    {
        Yii::$app->authManager->removeAll();
        $this->stdout('Done! Data has been successfully removed' . PHP_EOL);
    }
}