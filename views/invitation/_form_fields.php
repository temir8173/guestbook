<?php

use app\models\Invitation;
use app\models\Section;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/**
 * @var ActiveForm $form
 * @var Invitation $invitation
 * @var array $fieldValues
 * @var Section $section
 */

$fieldValues = $invitation->field_values;

?>

<?php $j = 0; foreach ($section->fields as $fIndex => $field) { ?>
    <?php
    if (in_array($field->type, ['text', 'link', 'youtube'])) {
        echo $form->field($field, 'slug', ['enableClientValidation' => false])
            ->textInput([
                'id' => "field-{$field->slug}",
                'name' => "Field[{$field->slug}]",
                'value' => $fieldValues[$field->slug] ?? $field->default_value ?? '',
                'placeholder' => $field->hint ?? '',
            ])
            ->label(Yii::t('common', $field->name));
    } elseif ($field->type == 'textarea') {
        echo '<div class="form-group">';
        echo Html::label($field->name, "field-{$field->slug}");
        echo CKEditor::widget([
            'name' => "Field[{$field->slug}]",
            'value' => $fieldValues[$field->slug] ?? $field->default_value ?? '',
            'editorOptions' => [
                'preset' => 'standard', //basic, standard, full
                'inline' => false,
            ],
            'options' => ['id' => "field-{$field->slug}"],
        ]);
        echo '</div>';
//                                echo $form->field(
//                                        $field,
//                                        'slug',
//                                        ['enableClientValidation' => false]
//                                )
//                                    ->widget(CKEditor::class, [
//                                        'name' => "Field[]{$field->slug}",
//                                        'value' => $fieldValues[$field->slug] ?? '',
//                                        'editorOptions' => [
//                                            'preset' => 'standart', //basic, standard, full
//                                            'inline' => false,
//                                        ],
//                                    ])->label(Yii::t('common', $field->name));
    } elseif ($field->type === 'image') {
        ?>
        <div class="container">
            <div class="row">
                <h4><?= Yii::t('common', $field->name) ?></h4>
                <div class="invitations-form__images restaurant-pic">
                    <?php if (isset($fieldValues[$field->slug])) { ?>
                        <?php foreach ($fieldValues[$field->slug] as $imageName) { ?>
                            <div class="col-sm-2">
                                <span class="image-span">
                                    <span class="image-del" data-action-url="<?= Url::to(['/api/delete-image']) ?>"
                                          data-invitation-id="<?= $invitation->id ?>"
                                          data-field-slug="<?= $field->slug ?>"
                                          data-image-name="<?= $imageName ?>"
                                    >x</span>
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
        <div id="upload-container-<?= $section->id ?>-<?= $j ?>" class="upload-container" data-action="">
            <img id="upload-image" src="/images/upload.svg">
            <div>
                <?= $form->field(
                    $field,
                    'slug',
                    [
                        'enableClientValidation' => false,
                        'template' => "{label}<span> ".Yii::t('common', 'немесе мұнда сүйретіп алып келіңіз')."</span>\n{input}"
                    ]
                )->fileInput([
                    'id' => "field-{$field->slug}",
                    'name' => "Field[{$field->slug}][]",
                    'multiple' => true
                ])->label(Yii::t('common', 'Файл таңдаңыз')); ?>
            </div>
        </div>
        <div class="preview container">
            <p><?= Yii::t('common', 'Файлдар таңдалмаған') ?></p>
        </div>
    <?php } elseif ($field->type == 'map') { ?>

        <?= Yii::t('common', 'Маркер координаталары') ?>: <div id="location">LatLng(54.98, 82.89)</div>
        <div id="map" class="address__map-container iframe-container"></div>
        <script src="https://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script>

        <?= $form->field(
            $field,
            'slug',
            ['enableClientValidation' => false])
            ->textInput([
                'id' => 'coorsInput',
                'name' => "Field[{$field->slug}]value",
                'value' => $fieldValues[$field->slug] ?? '',
            ])
            ->label(false); ?>

    <?php } ?>


<?php $j++; } ?>