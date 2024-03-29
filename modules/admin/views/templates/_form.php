<?php

use app\lists\TemplateTypesList;
use app\models\Section;
use app\models\Template;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Template $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="messages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
    // Fetch the existing value of preview_img from the database
    $model->preview_img = Yii::getAlias('@webroot') . '/' . Template::PREVIEW_IMAGE_PATH . $model->preview_img;

    ?>

    <?= $form->field($model, 'preview_img')->fileInput() ?>
    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'discount_price')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'sections')
        ->dropDownList(
            Section::find()->select(['name', 'slug'])->indexBy('slug')->column(),
            [
                'multiple' => true,
                'class' => 'form-control custom-dropdown-height',
                'options' => array_map(
                    function ($value) {
                        return ['selected' => 'selected'];
                    },
                    array_keys($model->sections ?? [])
                ),
            ],
        ) ?>

    <?= $form->field($model, 'type')->dropDownList(TemplateTypesList::getAll()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
