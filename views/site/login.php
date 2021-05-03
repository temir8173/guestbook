<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Кіру';
?>
<div class="login-section">
    
    <div class="container">
        
        <div class="site-login">
            <h1><?= Html::encode($this->title) ?></h1>

            <div class="shadow-box">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-12 '],
                    ],
                    'options' => [
                        'class' => 'login-form',
                    ]
                ]); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <div class="form-group">
                        <div class="col-lg-12">
                            <?= Html::submitButton('Кіру', ['class' => 'btn btn-primary login-button', 'name' => 'login-button']) ?>
                        </div>
                    </div>

                    <div class="login-forgot">
                        Құпия сөзіңізді ұмытқан болсаңыз <?= Html::a('мұнда', ['site/request-password-reset']) ?> қалпына келтіре аласыз.
                    </div>

                <?php ActiveForm::end(); ?>
            </div>

        </div>

    </div>
</div>