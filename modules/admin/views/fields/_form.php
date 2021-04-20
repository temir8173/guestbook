<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\SectionTemplates;

/* @var $this yii\web\View */
/* @var $model app\models\Fields */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fields-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'section_template_id')->dropDownList(SectionTemplates::find()->select(['name', 'id'])->indexBy('id')->column(), ['prompt' =>'-- таңдаңыз --']) ?>

    <?= $form->field($model, 'type')->dropDownList($model->types) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
