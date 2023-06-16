<?php

use app\models\Invitation;
use app\models\Wish;
use yii\helpers\Json;

/**
 * @var Invitation $invitation
 * @var Wish $newMessage
 */

$this->title = $invitation->name;
?>

<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="top-box">
                    <h1 class="top-box__title"><?= $invitation->name ?></h1>
                    <div class="top-box__row">

                    	<div id="countdown" class="top-box__time countdown"
                             data-event-date="<?= Yii::$app->formatter->asDate($invitation->event_date, 'php:j F Y') ?>">
							<div class="countdown-number">
								<span class="days countdown-time"></span>
								<span class="countdown-text">Күн</span>
							</div>
							<div class="countdown-number">
								<span class="hours countdown-time"></span>
								<span class="countdown-text">Сағат</span>
							</div>
							<div class="countdown-number">
								<span class="minutes countdown-time"></span>
								<span class="countdown-text">Минут</span>
							</div>
							<div class="countdown-number">
								<span class="seconds countdown-time"></span>
								<span class="countdown-text">Секунд</span>
							</div>
						</div>
						<div id="deadline-message" class="deadline-message">
						
						</div>

                    	<span class="top-box__date"><?= Yii::$app->formatter->asDate($invitation->event_date) ?></span>
                    </div>
                    <a href="#speech" class="top-box__arrow scrollto">
						<img class="top-box__arrow-img" src="/images/template1/angle-arrow-pointing-down.svg" alt="...">
					</a>
                </div>
            </div>
        </div>
    </div>
</header>

<?php

$fieldValues = Json::decode($invitation->field_values);
foreach (Json::decode($invitation->sections) as $section)
{
    echo $this->render('_'.$section, compact('invitation', 'newMessage', 'fieldValues'));
//    break;
}

?>
