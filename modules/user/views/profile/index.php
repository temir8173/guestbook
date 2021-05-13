<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<div class="container">
    <div class="profile-index">


        <div class="content_box">
            <h1>Профиль</h1>
        </div>

        <div class="content_box">
            <p><span>Атыңыз: </span><?= $user->username ?></p>
            <p><span>Email: </span><?= $user->email ?></p>
        </div>

        <div class="shadow-box">
                <p class="signup-info">Жаңа құпия сөзді енгізіңіз:</p>
                <div class="row">
                    <div class="col-lg-12">
             
                        <?php $form = ActiveForm::begin([
                            'id' => 'reset-password-form',
                            'action' => '/user/profile/reset-password',
                            'options' => [
                                'class' => 'login-form',
                            ]
                        ]); ?>
                            <?= $form->field($resetPwdForm, 'password')->passwordInput(['autofocus' => true]) ?>
                            <?= $form->field($resetPwdForm, 'password_repeat')->passwordInput(['autofocus' => true]) ?>
                            <div class="form-group">
                                <?= Html::submitButton('Сақтау', ['class' => 'btn btn-primary login-button']) ?>
                            </div>
                        <?php ActiveForm::end(); ?>
             
                    </div>
                </div>
            </div>

    </div>
</div>
