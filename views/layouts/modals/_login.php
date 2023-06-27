<?php

use app\forms\LoginForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var LoginForm $loginForm
 */
$loginForm = $this->params['loginForm'] ?? null;

?>
<div class="modal fade modal-login app-login-modal auth-modal" id="modal-login" tabindex="-1"
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
                            'id' => 'login-form',
                            'action' => 'auth/login',
                            'fieldConfig' => [
                                'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                                'labelOptions' => ['class' => 'col-lg-12 '],
                            ],
                            'options' => [
                                'class' => 'login-form app-modal-connect-form',
                            ]
                        ]); ?>

                        <?= $form->field($loginForm, 'username')->textInput(['autofocus' => true]) ?>
                        <?= $form->field($loginForm, 'password')->passwordInput() ?>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <?= Html::submitButton(Yii::t('common', 'Кіру'), ['class' => 'btn btn-primary login-button', 'name' => 'login-button']) ?>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>
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

                    <div class="login-forgot">
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
