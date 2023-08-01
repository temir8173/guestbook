<?php

/**
 * @var array $fieldValues
 * @var Invitation $invitation
 */

use app\models\Invitation;

?>
<section class="invitation">
    <div class="container">
        <div class="invitation-inner">
            <div class="invitation-title text-center title">Тойға шақыру</div>
            <div class="d-flex w-100 justify-content-around flex-wrap align-content-center justify-content-xl-center
             justify-content-lg-center justify-content-md-around">
                <div class="invitation-text">
                    <?= $fieldValues['invite_words'] ?? null ?>
                    <div class="invitation-owner">
                        Той иелері: <?= $fieldValues['wedding_owners'] ?? null ?>
                    </div>
                </div>

                <div class="invitation-photo">
                    <img class="invitation-photo-img w-100" src="/uploads/<?= $invitation->image ?>" alt="">
                </div>
            </div>
        </div>
    </div>
</section>