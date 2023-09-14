<?php

use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\base\Model;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var Model $model
 */

?>

<div class="site-login">
    <div class="modal-header">
        <?= Yii::t('common', 'Құпия сөзді қалпына келтіру') ?>
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
            <?= $form->field($model, 'email', [
                'template' => "<span class='icon'><ion-icon name='mail'></ion-icon></span>{input}{label}{error}",
            ])->textInput(['autofocus' => true, 'required' => true]) ?>
            <?= $form->field($model, 'reCaptcha', ['options' => ['class' => 'recaptcha-input']])
                ->widget(ReCaptcha2::class, []) ?>
            <?= Html::submitButton(Yii::t('common', 'Жіберу'), ['class' => 'btn btn-primary login-button mt-1']) ?>
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
                Yii::t('common', 'Тіркелу'),
                ['/auth/signup'],
                [
                    'class' => 'app-open-auth-modal',
                    'data-bs-target' => '#auth-modal',
                ]
            )
            ?>
        </div>
    </div>
</div>