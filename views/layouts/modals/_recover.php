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
        <div class="modal-content">
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
                        <?= $form->field($recoverRequestForm, 'email')->textInput(['autofocus' => true]) ?>
                        <?php if (!YII_DEBUG) { ?>
                            <?= $form->field($recoverRequestForm, 'reCaptcha')
                                ->widget(ReCaptcha2::class, []) ?>
                        <?php } ?>
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('common', 'Жіберу'), ['class' => 'btn btn-primary login-button']) ?>
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