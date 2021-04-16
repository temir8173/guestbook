<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Invitations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invitations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url', [
        'template' => '
            <div class="input-group">
                <span class="input-group-addon">'.Url::base(true).'/</span>
                {input}
            </div>
            {error}',
    ]); ?>

    <?= $form->field($model, 'event_date')->widget(DatePicker::class, [
        'options' => [
            'value' => ($model->event_date != null) ? Yii::$app->formatter->asDate($model->event_date) : $model->event_date,
        ],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd.mm.yyyy',
            'todayHighlight' => true,
        ]
    ]); ?>

    <?= $form->field($model, 'template')->dropDownList(['saf' => 'template1', 'test' => 'template2']) ?>

    <?= $form->field($model, 'created_date')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'updated_date')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
