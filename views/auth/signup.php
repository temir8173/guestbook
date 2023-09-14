<?php

use app\forms\SignupForm;
use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var Model $model
 */

?>

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
                    'class' => 'login-form async-form',
                    'data-reload' => 1
                ]
            ]); ?>
            <?= $form->field($model, 'username', [
                'template' => "<span class='icon'><ion-icon name='person'></ion-icon></span>{input}{label}{error}",
            ])->textInput(['autofocus' => true, 'required' => true]) ?>
            <?= $form->field($model, 'email', [
                'template' => "<span class='icon'><ion-icon name='mail'></ion-icon></span>{input}{label}{error}",
            ])->textInput(['required' => true]) ?>
            <?= $form->field($model, 'password', [
                'template' => "<span class='icon'><ion-icon name='lock-closed'></ion-icon></span>{input}{label}{error}",
            ])->passwordInput(['required' => true]) ?>
            <?= $form->field($model, 'password_repeat', [
                'template' => "<span class='icon'><ion-icon name='key'></ion-icon></span>{input}{label}{error}",
            ])->passwordInput(['required' => true]) ?>
            <?= $form->field($model, 'reCaptcha', ['options' => ['class' => 'recaptcha-input']])
                ->widget(ReCaptcha2::className(), []) ?>
            <div class="col-lg-12">
                <?= Html::submitButton(Yii::t('common', 'Тіркелу'), ['class' => 'btn btn-primary login-button mt-1', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="modal-footer">
        <div class="login-forgot">
            <?= Html::a(
                Yii::t('common', 'Кіру'),
                ['/auth/login'],
                [
                    'class' => 'app-open-auth-modal',
                    'data-bs-target' => '#auth-modal',
                ]
            ) ?>
            <?= Html::a(
                Yii::t('common', 'Құпия сөзді қалпына келтіру'),
                ['/auth/recover-request'],
                [
                    'class' => 'app-open-auth-modal',
                    'data-bs-target' => '#auth-modal',
                ]
            )
            ?>
        </div>
    </div>
</div>