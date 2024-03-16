<?php

use app\models\Audio;
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
 * @var array $audioItems
*/

?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="invitations-form">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <?= $form->field($invitation, 'name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($invitation, 'event_name')->textInput(['maxlength' => true]) ?>
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

                <?= $form->field($invitation, 'locale')->dropDownList([
                    'kk' => 'қазақ',
                    'ru' => 'русский',
                ], [
                    'class' => 'form-control text required'
                ]) ?>

                <?= $form->field($invitation, 'audio')->dropDownList($audioItems, [
                    'class' => 'form-control text required app-audio-dropdown',
                    'prompt' => Yii::t('common', '-- Таңдаңыз --')
                ]) ?>

                <audio controls id="app-audio-dropdown-player" data-path-pre="<?= '/' . Audio::AUDIO_PATH ?>">
                    <source src="<?= '/' . Audio::AUDIO_PATH . $invitation->audio ?>" type="audio/mp3">
                </audio>

                <div class="invitations-form__images restaurant-pic">
                    <span class="image-span">
                            <div class="invitation-image-preview">
                                <img src="/uploads/<?= $invitation->image ?>" alt="">
                            </div>
                    </span>
                </div>
                <div class="upload-box">
                    <div id="upload-container-inv" class="upload-container" data-action="">
                        <img id="upload-image" src="/images/upload.svg">
                        <div>
                            <?= $form->field(
                                $invitation,
                                'image',
                                [
                                    'enableClientValidation' => false,
                                    'template' => "{label}<span> ".Yii::t('common', 'немесе мұнда сүйретіп алып келіңіз')."</span>\n{input}"
                                ]
                            )->fileInput([
                                'id' => "invitation-image",
                                'multiple' => false
                            ])->label(Yii::t('common', 'Файл таңдаңыз')); ?>
                        </div>
                    </div>
                    <div class="preview inv-preview container">
                        <p><?= Yii::t('common', 'Файлдар таңдалмаған') ?></p>
                    </div>
                </div>


                <?php foreach ($sections as $index => $section ) : ?>
                    <?php
                    $inputAttributes = [
                        'id' => "section-{$index}-slug",
                        'value' => $section->slug
                    ];
                    $isSectionActive = true;
                    if (
                        is_array($invitation->sections)
                        && !in_array($section->slug, $invitation->sections)
                    ) {
                        $inputAttributes['disabled'] = true;
                        $isSectionActive = false;
                    }
                    ?>
                    <section class="invitations-form__section <?= !$isSectionActive ? 'inactive' : '' ?>">
                        <h2>
                            <span><?= $index + 1 ?></span>. Секция - <?= $section->localeName ?>
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
