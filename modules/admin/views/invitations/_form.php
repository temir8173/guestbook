<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\models\User;

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
    <?= $form->field($model, 'status')->dropDownList($model->statusLabels) ?>
    <?= $form->field($model, 'user_id')->dropDownList(User::find()->select(['username', 'id'])/*->where(['role' => 'user'])*/->indexBy('id')->column(), ['prompt' =>'-- таңдаңыз --']) ?>

    <?php foreach ( $sectionTemplates as $index => $sectionTemplate ) : ?>


        <section class="invitations-form__section">

            <h2><span><?= $index+1 ?></span>. Секция - <?= $sectionTemplate->name ?></h2>

            <?php // echo $form->field($sections[$index], "[$index]invitation_id")->hiddenInput(['value' => $model->id])->label(false) ?>
            <?= $form->field($sections[$index], "[$index]section_template_id")->hiddenInput(['value' => $sectionTemplate->id])->label(false) ?>
            <?= $form->field($sections[$index], "[$index]order")->hiddenInput(['value' => $model->isNewRecord ? $index+1 : $sections[$index]->order])->label(false) ?>
            <?php $sections[$index]->isNewRecord==1 ? $sections[$index]->status=1:$sections[$index]->status;?>
            <?= $form->field($sections[$index], "[$index]status")->radioList([1 => 'иә', 0 => 'жоқ'])->label() ?>

            <?php $j = 0; foreach ($sectionTemplate->fields as $field) { ?>

                <?php if (!empty($fieldValues[$sectionTemplate->id])) { ?>
                    
                    <?= $form->field($fieldValues[$sectionTemplate->id][$j], "[$sectionTemplate->id][$j]field_id")->hiddenInput(['value' => $field->id])->label(false) ?>
                    <?php
                        if ($field->type == 'text' || $field->type == 'link' || $field->type == 'youtube') {
                            echo $form->field($fieldValues[$sectionTemplate->id][$j], "[$sectionTemplate->id][$j]value")->textInput()->label($field->name);
                        } elseif ($field->type == 'textarea') {
                            echo $form->field($fieldValues[$sectionTemplate->id][$j], "[$sectionTemplate->id][$j]value")->textarea()->label($field->name);
                        } elseif ($field->type == 'image') {
                    ?>
                            <div class="container">
                                <div class="row">
                                    <h4><?= $field->name ?></h4>
                                    <div class="invitations-form__images restaurant-pic">
                                    <?php if ( is_array($fieldValues[$sectionTemplate->id][$j]->imagesNames) ) { ?>
                                        <?php foreach ($fieldValues[$sectionTemplate->id][$j]->imagesNames as $key => $imageName) { ?>
                                        <div class="col-sm-2">
                                            <span class="image-span">
                                                <span class="image-del" data-action-url="<?= Url::to(['/admin/invitations/delete-image']) ?>" data-id="<?= $fieldValues[$sectionTemplate->id][$j]->id ?>" data-index="<?= $key ?>">x</span>

                                                <a href="/uploads/<?= $imageName ?>" class="invitations-form__image-link">
                                                    <div class="our-gallery__image image-container gallery-vertical">
                                                        <div>
                                                            <img src="/uploads/<?= $imageName ?>" alt="">
                                                        </div>
                                                        
                                                    </div>
                                                </a>
                                            </span>
                                        </div>
                                        <?php } ?>
                                    <?php } ?>
                                    </div>
                                </div>
                                    
                            </div>
                            <div id="upload-container-<?= $fieldValues[$sectionTemplate->id][$j]->id ?>" class="upload-container" data-action="">
                                <img id="upload-image" src="/images/upload.svg">
                                <div>
                                    <?= $form->field($fieldValues[$sectionTemplate->id][$j], "[$sectionTemplate->id][$j]imageFiles[]", ['template' => "{label}<span> немесе мұнда сүйреп алып келіңіз</span>\n{input}"])->fileInput(['multiple' => true])->label('Файл таңдаңыз'); ?>
                                    
                                </div>
                            </div>
                            <div class="preview container">
                                <p>Файлдар таңдалмаған</p>
                            </div>
                    <?php } ?>

                <?php } ?>

            <?php $j++; } ?>

        </section>

    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
