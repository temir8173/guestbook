<?php

use app\lists\TemplateTypesList;
use app\models\Audio;
use app\models\Section;
use app\models\Template;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Audio $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="messages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
    // Fetch the existing value of preview_img from the database
    // $model->path = Yii::getAlias('@webroot') . '/' . Audio::AUDIO_PATH . $model->path;
//var_dump($model);
    ?>
    <audio controls><source src="<?= $model->audio ?>" type="audio/mp3"></audio>

    <?= $form->field($model, 'path')->fileInput() ?>

    <?= $form->field($model, 'type')->dropDownList(TemplateTypesList::getAll()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
