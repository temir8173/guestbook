<?php

use app\models\Invitation;
use app\lists\GuestAnswersList;
use app\models\Wish;
use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var array $fieldValues
 * @var Invitation $invitation
 * @var Wish $newMessage
 */
$eventDate = new \DateTime($invitation->event_date, new \DateTimeZone(Yii::$app->getTimeZone()));

?>

<div class="common-box">


    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="top-box">
                        <h1 class="top-box__title animate animate-in"><?= $invitation->name ?></h1>
                        <p class="animate animate-in">Үйлену той</p>
                    </div>
                </div>
            </div>
            <span class="wedding-background-bottom" data-offset="-100"></span>
        </div>
    </header>

    <section id="speech" class="speech">
        <div class="container">
            <?php if ($invitation->image) { ?>
                <div class="invitation-photo animate animate-out" data-offset="-400">
                    <img class="invitation-photo-img" src="/uploads/<?= $invitation->image ?>" alt="">
                </div>
            <?php } ?>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8" style="position:relative;">
                    <div class="speech__text animate animate-right" data-offset="-100">
                        <?= $fieldValues['invite_words'] ?? null ?>
                    </div>
                    <?php if (0) { ?>
                        <div class="speech__date animate animate-left">
                    <span class="top-box__date">
                        <?= Yii::$app->formatter->asDate($eventDate) ?>
                    </span>
                            <span class="top-box__date">
                        <?= Yii::$app->formatter->asDatetime($eventDate, 'php:H:i') ?>
                    </span>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <section id="calendar" class="calendar">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <p class="calendar_h animate animate-left">Той салтанаты</p>
                    <p class="calendar_p animate animate-left">14 шілде 2024 жылы <br> сағат 17:00</p>
                    <div class="calendar_img animate animate-left">
                        <img src="/images/uzatu3/calendar14.07.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="address" class="address">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="address__title section-title animate animate-up"><?= $fieldValues['place_section_name'] ?? null
                        ?></h2>
                    <div class="address__place animate animate-up">
                        <p><?= $fieldValues['place_restaurant'] ?? null ?></p>
                        <p><?= $fieldValues['place_address'] ?? null ?></p>
                        <?php if(isset($fieldValues['place_link']) && $fieldValues['place_link']) { ?>
                            <a target="_blank" href="<?= $fieldValues['place_link'] ?? null ?>">
                                2GIS
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-12 d-flex align-items-end">
                    <div id="map" class="address__map-container iframe-container animate animate-out"
                         data-offset="-200"
                         data-coors='<?= $fieldValues['place_map_widget'] ?? null ?>'></div>
                    <script src="https://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script>
                    <script type="text/javascript">
                        let map;
                        const coors = document.getElementById('map').getAttribute("data-coors");

                        DG.then(function () {
                            map = DG.map('map', {
                                center: [JSON.parse(coors).lat + 0.001, JSON.parse(coors).lng],
                                zoom: 16,
                                fullscreenControl: false,
                                zoomControl: false
                            });

                            DG.marker(JSON.parse(coors)).addTo(map).bindPopup(
                                '<div class="address__place"><p><?= $fieldValues['place_restaurant'] ?? null ?></p><span><?=
                                    $fieldValues['place_address'] ?? null ?></span></div>'
                            ).openPopup();
                        });
                    </script>

                </div>
                <div class="col-12">
                    <p class="speech__owners animate animate-left">
                        <span><?= Yii::t('common', 'Той иелері: ') ?></span>
                        <?= $fieldValues['wedding_owners'] ?? null ?>
                    </p>
                </div>
            </div>
        </div>
    </section>


    <section id="countdown-section">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-12">
                    <h2 class="countdown-section__title section-title animate animate-up">
                        Тойға дейін
                    </h2>
                    <div id="countdown" class="top-box__time countdown"
                         data-event-date="<?= Yii::$app->formatter->asDate($eventDate, 'php:Y-m-j H:i:s')
                         ?>">
                        <div class="countdown-number">
                            <span class="days countdown-time"></span>
                            <span class="countdown-text"><?= Yii::t('common', 'Күн') ?></span>
                        </div>
                        <div class="countdown-number">
                            <span class="hours countdown-time"></span>
                            <span class="countdown-text"><?= Yii::t('common', 'Сағат') ?></span>
                        </div>
                        <div class="countdown-number">
                            <span class="minutes countdown-time"></span>
                            <span class="countdown-text"><?= Yii::t('common', 'Минут') ?></span>
                        </div>
                        <div class="countdown-number">
                            <span class="seconds countdown-time"></span>
                            <span class="countdown-text"><?= Yii::t('common', 'Секунд') ?></span>
                        </div>
                    </div>
                    <div id="deadline-message" class="deadline-message">

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wishes" class="wishes">
        <div class="container wishes-box-container">
            <div class="row  justify-content-center">
                <h2 class="wishes__title section-title animate animate-up"><?= $fieldValues['wishes_name'] ?? null ?></h2>
                <div class="col-md-9 wish-first-col">

                    <div class="wishes__messages animate animate-out" data-offset="-300">
                        <div id="messages-box"
                             data-action-url="<?= Url::to([
                                 '/invitation/get-wishes',
                                 'invitationId' => $invitation->id
                             ]) ?>">
                            <?= $this->render('_wishes_box', ['wishes' => $invitation->wishes]); ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="container">
            <div class="row  justify-content-center">
                <div class="col-md-9">

                    <?php $form = ActiveForm::begin([
                        'action' => Url::to('/invitation/add-wish'),
                        'enableClientValidation'=>false,
                        'options' => [
                            'class' => 'wishes__form ajax-form',
                        ],
                    ]); ?>

                    <?= $form->field($newMessage, "name")->textInput([
                        'placeholder' => Yii::t('common', 'Атыңыз'),
                        'class' => 'form-control text required',
                        'data' => [
                            'error-msg' => Yii::t('common', 'Міндетті түрде тотыру қажет'),
                        ],
                    ])->label(false) ?>
                    <?= $form->field($newMessage, "text")->textArea([
                        'placeholder' => Yii::t('common', 'Тілегіңіз'),
                        'class' => 'form-control text required',
                        'rows' => 5,
                        'data' => [
                            'error-msg' => Yii::t('common', 'Міндетті түрде тотыру қажет'),
                        ],
                    ])->label(false) ?>
                    <?= $form->field($newMessage, "answer")->dropDownList(GuestAnswersList::getAll(), [
                        'class' => 'form-control text required',
                        'data' => [
                            'error-msg' => Yii::t('common', 'Міндетті түрде тотыру қажет'),
                        ],
                    ])->label(Yii::t('common', 'Тойға келесіз бе?')) ?>
                    <?= $form->field($newMessage, 'reCaptcha')
                        ->widget(ReCaptcha2::class, []) ?>

                    <?= $form->field($newMessage, "date")->hiddenInput(['value' => ''])->label(false) ?>
                    <?= $form->field($newMessage, "invitation_id")->hiddenInput(['value' => $invitation->id])->label(false) ?>

                    <div class="wishes__form-btn">
                        <?= Html::submitInput(
                            Yii::t('common', 'Құттықтау'),
                            ['name' => 'submit', 'class' => 'btn']
                        ) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </section>

</div>
