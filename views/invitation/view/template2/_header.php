<?php

use app\models\Invitation;

/**
 * @var Invitation $invitation
 */

$names = explode(' ', $invitation->name);

$boyName = $names[0];
$girlName = $names[1] === '-' ? $names[2] : $names[1];

$eventDate = new \DateTime($invitation->event_date, new \DateTimeZone(Yii::$app->getTimeZone()));
$day = Yii::$app->formatter->asDate($eventDate, 'php:j');
$month = Yii::$app->formatter->asDate($eventDate, 'php:F');
$year = Yii::$app->formatter->asDate($eventDate, 'php:Y');
$dayOfWeek = Yii::$app->formatter->asDate($eventDate, 'php:l');
$time = Yii::$app->formatter->asDatetime($eventDate, 'php:H:i');

?>

<header class="header d-flex flex-wrap align-content-center text-center">
    <div class="header-bg d-flex flex-wrap align-content-center">



        <div class="container">

            <div class="wedding-name">
                <div class="wedding-name-list">
                    <div class="wedding-name-items"><?= $boyName ?></div>
                    <div class="wedding-name-items">
                        <img class="wedding-name-items-img" src="./images/infinite-2.png" alt="">
                    </div>
                    <div class="wedding-name-items"><?= $girlName ?></div>

                </div>
                <!--  <div class="wedding-name-text">23.10.2021</div>-->
                <div class="wedding-date text-center m-auto">
                    <div class="wedding-date-center">
                        <div class="wedding-date-item left"><?= $dayOfWeek ?></div>
                        <div>
                            <div class="wedding-date-top"><?= $month ?></div>
                            <div class="wedding-date-item center"><?= $day ?></div>
                            <div class="wedding-date-bottom"><?= $year ?></div>
                        </div>
                        <div class="wedding-date-item right"><?= $time ?></div>

                    </div>

                </div>
            </div>


        </div>
    </div>
</header>
