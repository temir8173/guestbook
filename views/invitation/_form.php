<?php

use app\models\Invitation;
use app\models\Section;
use kartik\datetime\DateTimePicker;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var ActiveForm $form
 * @var Invitation $invitation
 * @var Section[] $sections
*/

?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="invitations-form">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <?= $form->field($invitation, 'name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($invitation, 'url', [
                    'template' => '
                    <div class="input-group">
                        <span class="input-group-addon">'.Url::base(true).'/</span>
                        {input}
                    </div>
                    {error}',
                ]); ?>

                <?= $form->field($invitation, 'event_date')->widget(DateTimePicker::class, [
                    'options' => [
                        'value' => $invitation->event_date,
                    ],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd h:i:s',
                        'todayHighlight' => true,
                    ]
                ]); ?>

                <?php foreach ($sections as $index => $section ) : ?>
                    <?php
                    $inputAttributes = [
                        'id' => "section-{$index}-slug",
                        'value' => $section->slug
                    ];
                    $isSectionActive = true;
                    if (
                        is_array($invitation->sections)
                        && !empty($invitation->sections)
                        && !in_array($section->slug, $invitation->sections)
                    ) {
                        $inputAttributes['disabled'] = true;
                        $isSectionActive = false;
                    }
                    ?>
                    <section class="invitations-form__section <?= !$isSectionActive ? 'inactive' : '' ?>">
                        <h2>
                            <span><?= $index + 1 ?></span>. Секция - <?= Yii::t('common', $section->name) ?>
                        </h2>
                        <?= $form->field($section, "slug[]")
                            ->hiddenInput($inputAttributes)->label(false) ?>

                        <?php if ($section->is_optional) { ?>
                            <label class="switch <?= $isSectionActive ? 'active' : '' ?>"
                                   data-section-id="section-<?= $index ?>-slug">
                                <span class="slider round"></span>
                            </label>
                        <?php } ?>

                        <?= $this->render('_form_fields', [
                            'form' => $form,
                            'section' => $section,
                            'invitation' => $invitation,
                            'isSectionActive' => $isSectionActive,
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
