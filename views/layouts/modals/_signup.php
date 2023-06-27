<?php

use app\forms\SignupForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var SignupForm $signupForm
 */
$signupForm = $this->params['signupForm'] ?? null;

?>

<div class="modal fade modal-login app-signup-modal auth-modal" id="modal-signup" tabindex="-1"
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
                            'id' => 'form-signup',
                            'options' => [
                                'class' => 'login-form',
                            ]
                        ]); ?>
                        <?= $form->field($signupForm, 'username')->textInput(['autofocus' => true]) ?>
                        <?= $form->field($signupForm, 'email') ?>
                        <?= $form->field($signupForm, 'password')->passwordInput() ?>
                        <?= $form->field($signupForm, 'password_repeat')->passwordInput() ?>
                        <?php if (0) { ?>
                            <?= $form->field($signupForm, 'reCaptcha')->widget(
                                \himiklab\yii2\recaptcha\ReCaptcha2::className(), []
                            ) ?>
                        <?php } ?>
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('common', 'Тіркелу'), ['class' => 'btn btn-primary login-button', 'name' => 'signup-button']) ?>
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

                    <div class="login-forgot">
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>