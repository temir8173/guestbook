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
            <div class="col-sm-12 p-0">
                <div class="top-box d-flex flex-column align-items-center">

                    <div class="invitation-photo">
                        <img class="invitation-photo-img" src="/uploads/<?= $invitation->image ?>" alt="">
                    </div>


                    <h1 class="top-box__title animate animate-in"><?= $invitation->name ?></h1>
                    <p class="uzatu_p animate animate-up" data-offset="0"><?= $invitation->event_name ?></p>
                </div>
            </div>
        </div>
    </div>
</header>
