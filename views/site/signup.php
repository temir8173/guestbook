<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
 
$this->title = Yii::t('common', 'Тіркелу');
?>
<div class="login-section signup-section">
    <div class="container">
        
        <div class="site-signup site-login">
            <h1><?= Html::encode($this->title) ?></h1>

            <div class="shadow-box">
                <p class="signup-info"><?= Yii::t('common', 'Тіркелу үшін келесі мәліметтерді енгізіңіз') ?></p>
                <div class="row">
                    <div class="col-lg-12">
             
                        <?php $form = ActiveForm::begin([
                            'id' => 'form-signup',
                            'options' => [
                                'class' => 'login-form',
                            ]
                        ]); ?>
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                            <?= $form->field($model, 'email') ?>
                            <?= $form->field($model, 'password')->passwordInput() ?>
                            <?= $form->field($model, 'password_repeat')->passwordInput() ?>
                            <?php if (0) { ?>
                                <?= $form->field($model, 'reCaptcha')->widget(
                                    \himiklab\yii2\recaptcha\ReCaptcha2::className(), []
                                ) ?>
                            <?php } ?>
                            <div class="form-group">
                                <?= Html::submitButton(Yii::t('common', 'Тіркелу'), ['class' => 'btn btn-primary login-button', 'name' => 'signup-button']) ?>
                            </div>
                        <?php ActiveForm::end(); ?>
             
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>