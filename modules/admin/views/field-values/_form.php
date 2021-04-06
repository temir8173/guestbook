<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FieldValues */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="field-values-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'invitation_id')->hiddenInput(['value' => $invitation_id]) ?>

    <?= $form->field($model, 'field_id')->textInput() ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
