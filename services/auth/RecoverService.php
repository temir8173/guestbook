<?php


namespace app\services\auth;


use app\models\User;
use app\models\UserIdentity;
use Yii;
use yii\base\Exception;

class RecoverService
{
    /**
     * @throws Exception
     */
    public function sendEmail(User $user): bool
    {
        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'recover-request-html', 'text' => 'recover-request-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->name . ' robot'])
            ->setTo($user->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
    }

    public function resetPassword(User $user, string $password): bool
    {
        $user->password = $password;
        $user->password_reset_token = null;
        $user->status = UserIdentity::STATUS_ACTIVE;

        return $user->save(false);
    }
}
