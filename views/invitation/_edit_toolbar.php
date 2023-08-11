<?php

use app\models\Invitation;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var Invitation $invitation
 */

$this->title = $invitation->name;
?>
<div class="preview-edit-toolbar">
    <div class="container">
        <div class="row">
            <div class="toolbar-links">
                <?php if ($invitation->is_demo) { ?>
                    <?= Html::a(
                        Yii::t('common', 'Басты бет'),
                        ['/'],
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
                    <?php if (!$invitation->is_demo) { ?>
                        <?= Html::a(
                            Yii::t('common', 'Басты бет'),
                            ['/'],
                        ) ?>
                    <?php } ?>
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
                        ['/'],
                    ) ?>
                    <?= Html::a(
                        Yii::t('common', 'Өзгерту'),
                        ['/invitation/update', 'url' => $invitation->url],
                    ) ?>
                    <?php if ($invitation->status === Invitation::STATUS_UNPAID) { ?>
                        <?= Html::a(
                            Yii::t('common', 'Төлем жасау'),
                            ['/payment/pay', 'orderId' => $invitation->order->id, 'returnUrl' => "/{$invitation->url}"],
                        ) ?>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>