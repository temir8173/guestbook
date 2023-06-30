<?php

use yii\helpers\Html;
use app\models\User;

/* @var $user User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup-confirm', 't' => $user->email_confirm_token]);
?>
<div class="password-reset">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Follow the link below to confirm your email:</p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
</div>