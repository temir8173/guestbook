<?php

use app\models\Invitation;

/**
 * @var Invitation $invitation
 */
$eventDate = new \DateTime($invitation->event_date, new \DateTimeZone(Yii::$app->getTimeZone()));

?>

<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="top-box">
                    <h1 class="top-box__title"><?= $invitation->name ?></h1>
                    <div class="top-box__row">

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

                        <span class="top-box__date">
                            <?= Yii::$app->formatter->asDate($eventDate) ?>
                        </span>
                        <span class="top-box__date">
                            <?= Yii::$app->formatter->asDatetime($eventDate, 'php:H:i') ?>
                        </span>
                    </div>
                    <a href="#speech" class="top-box__arrow scrollto">
                        <img class="top-box__arrow-img" src="/images/template1/angle-arrow-pointing-down.svg" alt="...">
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
