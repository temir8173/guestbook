<?php

use app\models\User;

/* @var $user User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup-confirm', 't' => $user->email_confirm_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to confirm your email:

<?= $confirmLink ?>