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

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

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

    <?= $form->field($model, 'template')->dropDownList($model->templates) ?>
    <?= $form->field($model, 'created_date')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'updated_date')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'status')->textInput() ?>

    <?php foreach ( $sectionTemplates as $index => $sectionTemplate ) : ?>


        <section class="invitations-form__section">

            <h2><span><?= $index+1 ?></span>. Секция - <?= $sectionTemplate->name ?></h2>

            <?php // echo $form->field($sections[$index], "[$index]invitation_id")->hiddenInput(['value' => $model->id])->label(false) ?>
            <?= $form->field($sections[$index], "[$index]section_template_id")->hiddenInput(['value' => $sectionTemplate->id])->label(false) ?>
            <?= $form->field($sections[$index], "[$index]order")->  textInput(['value' => $index+1])->label(false) ?>
            <?= $form->field($sections[$index], "[$index]status")->radioList([1 => 'иә', 0 => 'жоқ'])->label() ?>

            <?php $j = 0; foreach ($sectionTemplate->fields as $field) { ?>

                <?php if (!empty($fieldValues[$sectionTemplate->id])) { ?>
                    
                    <?= $form->field($fieldValues[$sectionTemplate->id][$j], "[$sectionTemplate->id][$j]field_id")->hiddenInput(['value' => $field->id])->label(false) ?>
                    <?php
                        if ($field->type == 'text' || $field->type == 'link') {
                            echo $form->field($fieldValues[$sectionTemplate->id][$j], "[$sectionTemplate->id][$j]value")->textInput()->label($field->name);
                        } elseif ($field->type == 'textarea') {
                            echo $form->field($fieldValues[$sectionTemplate->id][$j], "[$sectionTemplate->id][$j]value")->textarea()->label($field->name);
                        } elseif ($field->type == 'image') {
                            ?>
                            <div class="container">
                                <div class="row">
                                    <?php if ( is_array($fieldValues[$sectionTemplate->id][$j]->imagesNames) ) { ?>
                                        <?php foreach ($fieldValues[$sectionTemplate->id][$j]->imagesNames as $key => $imageName) { ?>
                                        <div class="col-sm-3">
                                            <img src="/uploads/<?= $imageName ?>" alt="">
                                        </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <?= $fieldValues[$sectionTemplate->id][$j]->value ?>
                                    
                            </div>
                            <?php
                            echo $form->field($fieldValues[$sectionTemplate->id][$j], "[$sectionTemplate->id][$j]imageFiles[]")->fileInput(['multiple' => true])->label($field->name);
                        } 
                    ?>

                <?php } ?>

            <?php $j++; } ?>

        </section>

    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
