<?php

namespace app\services\auth;

use app\models\UserIdentity;
use Yii;
use yii\base\Exception;

class SignupService
{
    /**
     * @throws Exception
     */
    public function process(array $userData, $isConfirmRequired = true): UserIdentity
    {
        $user = new UserIdentity();
        $user->username = $userData['username'];
        $user->email = $userData['email'];
        $user->password = $userData['password'] ?? Yii::$app->security->generateRandomString(16);
        $user->role = 'user';
        $user->generateAuthKey();
        $user->email_confirm_token = $isConfirmRequired ? Yii::$app->security->generateRandomString() : '';
        $user->status = $isConfirmRequired ? UserIdentity::STATUS_WAIT : UserIdentity::STATUS_ACTIVE;
        if(!$user->save()){
            throw new \RuntimeException('Saving error.');
        }

        if ($isConfirmRequired) {
            $this->sendEmailConfirm($user);
        }

        return $user;
    }

    private function sendEmailConfirm(UserIdentity $user)
    {
        $isSent = Yii::$app->mailer
            ->compose(
                ['html' => 'confirm-request-html', 'text' => 'confirm-request-text'],
                ['user' => $user])
            ->setTo($user->email)
            ->setFrom(Yii::$app->params['senderEmail'])
            ->setSubject('Confirmation of registration')
            ->send();

        if (!$isSent) {
            throw new \RuntimeException('Sending error.');
        }
    }

    public function confirm(string $token)
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token.');
        }

        $user = UserIdentity::findOne(['email_confirm_token' => $token]);
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