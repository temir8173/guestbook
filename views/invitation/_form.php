<?php

use app\models\Invitation;
use app\models\Section;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/**
 * @var View $this
 * @var ActiveForm $form
 * @var Invitation $model
 * @var Section[] $sections
 * @var string[] $templateNames
*/
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">

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
                        'value' => $model->event_date,
                    ],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                    ]
                ]); ?>

                <?= $form->field($model, 'template_id')->dropDownList($templateNames) ?>
                <?= $form->field($model, 'status')->hiddenInput(['value' => $model->isNewRecord ? 0 : $model->status])->label(false) ?>
                <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

                <?php foreach ($sections as $index => $section ) : ?>


                    <section class="invitations-form__section">

                        <h2><span><?= $index+1 ?></span>. Секция - <?= Yii::t('common', $section->name) ?></h2>

                        <?= $form->field($section, "slug[]")
                            ->textInput([
                                'id' => "section-{$index}-slug",
                                'value' => $section->slug
                            ])
                            ->label(false) ?>
                        <label class="switch active" data-section-id="section-<?= $index ?>-slug">
                            <span class="slider round"></span>
                        </label>

                        <?= $this->render('_form_fields', [
                            'form' => $form,
                            'section' => $section,
                        ]); ?>

                    </section>

                <?php endforeach; ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('common', 'Сақтау'), ['class' => 'btn btn-info save-invitation-btn']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
