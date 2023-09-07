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
<div class="modal fade modal-login app-login-modal auth-modal" id="modal-login" tabindex="-1"
     aria-labelledby="modal-login-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content wrapper">
            <div class="site-login">
                <button type="button" class="icon-close" data-bs-dismiss="modal" aria-label="Close">
                    <span class="">
                        <ion-icon name="close"></ion-icon>
                    </span>
                </button>
                <div class="modal-header">
                    <?= Yii::t('common', 'Кіру') ?>
                </div>
                <div class="modal-body pt-0">
                    <div class="modal-form-box">
                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'action' => Yii::$app->language === 'kk' ? 'auth/do-login' : 'ru/auth/do-login',
                            'fieldConfig' => [
                                'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                                'labelOptions' => ['class' => 'col-lg-12 '],
                            ],
                            'options' => [
                                'class' => 'login-form app-modal-connect-form async-form',
                                'data-redirect' => '/'
                            ]
                        ]); ?>

                        <?= $form->field($loginForm, 'username', [
                            'template' => "<span class='icon'><ion-icon name='mail'></ion-icon></span>{input}{label}{error}",
                        ])->textInput(['autofocus' => true, 'required' => true]) ?>
                        <?= $form->field($loginForm, 'password', [
                            'template' => "<span class='icon'><ion-icon name='lock-closed'></ion-icon></span>{input}{label}{error}",
                        ])->passwordInput(['required' => true]) ?>

                        <div class="col-lg-12">
                            <?= Html::submitButton(Yii::t('common', 'Кіру'), ['class' => 'btn btn-primary login-button', 'name' => 'login-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="oauth-services">
                        <?php $returnUrl = Yii::$app->session->get('oauthReturnUrl') ?? Url::current() ?>
                        <a class="app-google-oauth-btn"
                           href="<?= Url::to(['/auth/google-login', 'returnUrl' => $returnUrl]) ?>">
                            <img src="/images/google_icon.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="login-forgot">
                        <?= Html::a(
                            Yii::t('common', 'Тіркелу'),
                            ['auth/signup'],
                            [
                                'data-bs-toggle' => 'modal',
                                'data-bs-target' => '#modal-signup',
                                'data-bs-backdrop' => 'false',
                            ]
                        ) ?>
                        <?= Html::a(
                            Yii::t('common', 'Құпия сөзді қалпына келтіру'),
                            ['auth/request-password-reset'],
                            [
                                'data-bs-toggle' => 'modal',
                                'data-bs-target' => '#modal-recover',
                                'data-bs-backdrop' => 'false',
                            ]
                        )
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
