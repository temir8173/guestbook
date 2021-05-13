<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
 
$this->title = Yii::t('common', 'Құпия сөзді қалпына келтіру');
$this->params['breadcrumbs'][] = $this->title;
?>
 
<div class="login-section">
    <div class="container">
        <div class="site-reset-password site-login">
            <h1><?= Html::encode($this->title) ?></h1>

            <div class="shadow-box">
                <p class="signup-info"><?= Yii::t('common', 'Жаңа құпия сөзді енгізіңіз') ?></p>
                <div class="row">
                    <div class="col-lg-12">
             
                        <?php $form = ActiveForm::begin([
                            'id' => 'reset-password-form',
                            'options' => [
                                'class' => 'login-form',
                            ]
                        ]); ?>
                            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
                            <?= $form->field($model, 'password_repeat')->passwordInput(['autofocus' => true]) ?>
                            <div class="form-group">
                                <?= Html::submitButton(Yii::t('common', 'Сақтау'), ['class' => 'btn btn-primary login-button']) ?>
                            </div>
                        <?php ActiveForm::end(); ?>
             
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>