<?php

use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var Model $model
 */

?>
<div class="site-login">
    <button type="button" class="icon-close" data-bs-dismiss="modal" aria-label="Close">
        <span class="">
            <ion-icon name="close"></ion-icon>
        </span>
    </button>
    <div class="modal-header">
        <?= Yii::t('common', 'Кіру') ?>
        <?php if (0) { ?>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <?php } ?>
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
                ]
            ]); ?>

            <?= $form->field($model, 'phoneOrEmail', [
                'template' => "<span class='icon'><ion-icon name='mail'></ion-icon></span>{input}{label}{error}",
            ])->textInput(['autofocus' => true, 'required' => true]) ?>
            <?= $form->field($model, 'passwordOrCode', [
                'template' => "<span class='icon'><ion-icon name='lock-closed'></ion-icon></span>{input}{label}{error}",
            ])->passwordInput(['required' => true]) ?>

            <div class="col-lg-12">
                <?= Html::submitButton(Yii::t('common', 'Кіру'), ['class' => 'btn btn-primary login-button', 'name' => 'login-button']) ?>
                <?= Html::a(
                    Yii::t('common', 'Смс-код алу'),
                    Url::to(['/auth/send-code']),
                    ['class' => 'app-send-sms',]
                ) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="oauth-services">
            <?php $returnUrl = Yii::$app->session->get('oauthReturnUrl') ?? '/' ?>
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
                ['/auth/signup'],
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