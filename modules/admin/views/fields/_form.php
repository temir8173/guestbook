<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Section;

/**
 * @var yii\web\View $this
 * @var app\models\Field $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="fields-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'section_id')->dropDownList(Section::find()->select(['name', 'id'])->indexBy('id')->column(), ['prompt' =>'-- таңдаңыз --']) ?>
    <?= $form->field($model, 'type')->dropDownList($model->types) ?>
    <?= $form->field($model, 'hint')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'default_value')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
