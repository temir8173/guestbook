<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\Invitations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invitations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
	$form->field($model, 'name');
	?>

    <span></span><?= $form->field($model, 'url', [
    	'template' => '
            <div class="input-group">
                <span class="input-group-addon">'.Url::base(true).'/</span>
                {input}
            </div>
            {error}',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
