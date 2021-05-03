<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
 
$this->title = 'Құпия сөзді қалпына келтіру';
$this->params['breadcrumbs'][] = $this->title;
?>
 
<div class="login-section site-login">
    <div class="container">
        <div class="site-request-password-reset">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="shadow-box">
                <p class="signup-info">Email немесе логиныңызды енгізіңіз. Сізге сілтеме жіберіледі, сілтеме бойынша құпия сөзіңізді қалпына келтіре аласыз.</p>
                <div class="row">
                    <div class="col-lg-12">
             
                        <?php $form = ActiveForm::begin([
                            'id' => 'request-password-reset-form',
                            'options' => [
                                'class' => 'login-form',
                            ]
                        ]); ?>
                            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
                            <div class="form-group">
                                <?= Html::submitButton('Жіберу', ['class' => 'btn btn-primary login-button']) ?>
                            </div>
                        <?php ActiveForm::end(); ?>
             
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>