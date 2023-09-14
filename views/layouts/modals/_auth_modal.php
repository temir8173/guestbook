<?php

use app\forms\LoginForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var LoginForm $loginForm
 */
$loginForm = $this->params['loginForm'] ?? null;

?>
<div id="auth-modal" class="modal fade modal-login app-login-modal auth-modal" tabindex="-1"
     aria-labelledby="modal-login-label" aria-hidden="true" data-url="<?= Url::to('/auth/login') ?>"
    data-redirect="/">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content wrapper">

        </div>
    </div>
</div>
