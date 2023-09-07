<?php

use app\forms\RecoverRequestForm;
use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var RecoverRequestForm $recoverRequestForm
 */
$recoverRequestForm = $this->params['recoverRequestForm'] ?? null;

?>

<div class="modal fade modal-login app-login-modal auth-modal" id="modal-recover" tabindex="-1"
     aria-labelledby="modal-login-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content wrapper">
            <div class="site-login">
                <div class="modal-header">
                    <?= Html::encode($this->title) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <div class="modal-form-box">
                        <?php $form = ActiveForm::begin([
                            'id' => 'request-password-reset-form',
                            'action' => Yii::$app->language === 'kk' ? 'auth/recover-request' : 'ru/auth/recover-request',
                            'options' => [
                                'class' => 'login-form async-form',
                            ]
                        ]); ?>
                        <?= $form->field($recoverRequestForm, 'email', [
                            'template' => "<span class='icon'><ion-icon name='mail'></ion-icon></span>{input}{label}{error}",
                        ])->textInput(['autofocus' => true, 'required' => true]) ?>
                        <?= $form->field($recoverRequestForm, 'reCaptcha', ['options' => ['class' => 'recaptcha-input']])
                            ->widget(ReCaptcha2::class, []) ?>
                        <?= Html::submitButton(Yii::t('common', 'Жіберу'), ['class' => 'btn btn-primary login-button mt-1']) ?>
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
                            Yii::t('common', 'Тіркелу'),
                            ['auth/request-password-reset'],
                            [
                                'data-bs-toggle' => 'modal',
                                'data-bs-target' => '#modal-signup',
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