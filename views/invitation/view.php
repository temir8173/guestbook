<?php

use app\models\Invitation;
use app\models\Wish;
use yii\helpers\Html;
use yii\helpers\Url;

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

$fieldValues = $invitation->field_values;
foreach ($invitation->sections as $section)
{
    echo $this->render(
        'view/' . $invitation->template->slug . '/_' . $section,
        compact('invitation', 'newMessage', 'fieldValues')
    );
}

?>

<div class="preview-edit-toolbar">
    <div class="container">
        <div class="row">
            <div class="toolbar-links">
                <?php if ($invitation->is_demo) { ?>
                    <?= Html::a(
                        Yii::t('common', 'Басты бет'),
                        '/',
                    ) ?>
                    <?php if (Yii::$app->user->isGuest) { ?>
                        <a href="#" class="create-invitation-login" data-bs-toggle="modal" data-bs-target="#modal-login"
                        data-redirect="<?= Url::to(['/invitation/create', 'template' => $invitation->template->slug]) ?>">
                            <?= Yii::t('common', 'Жаңа шақырту') ?></a>
                    <?php } else { ?>
                        <?= Html::a(
                            Yii::t('common', 'Жаңа шақырту'),
                            ['/invitation/create', 'template' => $invitation->template->slug],
                        ) ?>
                    <?php } ?>
                <?php } ?>

                <?php if (Yii::$app->user->identity?->role === 'admin') { ?>
                    <?= Html::a(
                        Yii::t('common', 'Басты бет'),
                        '/',
                    ) ?>
                    <?= Html::a(
                        Yii::t('common', 'Өзгерту'),
                        ['/invitation/update', 'url' => $invitation->url],
                    ) ?>
                <?php } ?>

                <?php if (
                    Yii::$app->user->id === $invitation->user_id
                    && Yii::$app->user->identity?->role !== 'admin'
                ) { ?>
                    <?= Html::a(
                        Yii::t('common', 'Басты бет'),
                        '/',
                    ) ?>
                    <?= Html::a(
                        Yii::t('common', 'Өзгерту'),
                        ['/invitation/update', 'url' => $invitation->url],
                    ) ?>
                    <?php if ($invitation->status === Invitation::STATUS_UNPAID) { ?>
                        <?= Html::a(
                            Yii::t('common', 'Төлем жасау'),
                            ['/order/pay', 'url' => $invitation->url],
                        ) ?>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?= $this->render('@app/views/layouts/modals/_login'); ?>
<?= $this->render('@app/views/layouts/modals/_signup'); ?>
<?= $this->render('@app/views/layouts/modals/_recover'); ?>