<?php

use app\forms\SignupForm;
use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var SignupForm $signupForm
 */
$signupForm = $this->params['signupForm'] ?? null;

?>

<div class="modal fade modal-login app-signup-modal auth-modal" id="modal-signup" tabindex="-1"
     aria-labelledby="modal-login-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content wrapper">
            <div class="site-login">
                <div class="modal-header">
                    <?= Yii::t('common', 'Тіркелу') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <div class="modal-form-box">
                        <?php $form = ActiveForm::begin([
                            'id' => 'form-signup',
                            'action' => Yii::$app->language === 'kk' ? 'auth/signup' : 'ru/auth/signup',
                            'options' => [
                                'class' => 'login-form  async-form',
                                'data-reload' => 1
                            ]
                        ]); ?>
                        <?= $form->field($signupForm, 'username', [
                            'template' => "<span class='icon'><ion-icon name='person'></ion-icon></span>{input}{label}{error}",
                        ])->textInput(['autofocus' => true, 'required' => true]) ?>
                        <?= $form->field($signupForm, 'email', [
                            'template' => "<span class='icon'><ion-icon name='mail'></ion-icon></span>{input}{label}{error}",
                        ])->textInput(['required' => true]) ?>
                        <?= $form->field($signupForm, 'password', [
                            'template' => "<span class='icon'><ion-icon name='lock-closed'></ion-icon></span>{input}{label}{error}",
                        ])->passwordInput(['required' => true]) ?>
                        <?= $form->field($signupForm, 'password_repeat', [
                            'template' => "<span class='icon'><ion-icon name='key'></ion-icon></span>{input}{label}{error}",
                        ])->passwordInput(['required' => true]) ?>
                        <?= $form->field($signupForm, 'reCaptcha', ['options' => ['class' => 'recaptcha-input']])
                            ->widget(ReCaptcha2::className(), []) ?>
                        <div class="col-lg-12">
                            <?= Html::submitButton(Yii::t('common', 'Кіру'), ['class' => 'btn btn-primary login-button mt-1', 'name' => 'login-button']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="login-forgot">
                        <?= Html::a(
                            Yii::t('common', 'Кіру'),
                            ['auth/login'],
                            [
                                'data-bs-toggle' => 'modal',
                                'data-bs-target' => '#modal-login',
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