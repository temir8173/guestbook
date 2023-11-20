<?php

/**
 * @var array $fieldValues
 * @var Invitation $invitation
 */

use app\models\Invitation;

$eventDate = new \DateTime($invitation->event_date, new \DateTimeZone(Yii::$app->getTimeZone()));

?>
<section id="speech" class="speech">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-10 col-md-8" style="position:relative;">
				<div class="speech__text animate animate-right">
					<?= $fieldValues['invite_words'] ?? null ?>
				</div>
				<p class="speech__owners animate animate-left">
                    <?= Yii::t('common', 'Той иесі: ') ?>
                    <?= $fieldValues['wedding_owners'] ?? null ?></p>
			</div>
		</div>
        <div class="row justify-content-center">

            <div class="col-10">
                <div class="countdown-box animate animate-up">
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


                <div class="wedding_date animate animate-left">
                    <span class="top-box__date">
                        <?= Yii::$app->formatter->asDate($eventDate) ?>
                    </span>
                    <span class="top-box__date">
                        <?= Yii::$app->formatter->asDatetime($eventDate, 'php:H:i') ?>
                    </span>
                </div>
            </div>
        </div>
	</div>
</section>