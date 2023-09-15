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
                    <?php if (Yii::$app->user->isGuest) {
                        $authLink = Yii::$app->language === 'ru' ? '/ru/auth/login' : '/auth/login'; ?>
                        <a href="<?= $authLink ?>" class="app-open-auth-modal" data-bs-toggle="modal"
                           data-bs-target="#auth-modal"
                           data-redirect="<?= Url::to(['/invitation/create', 'template' => $invitation->template->slug]) ?>">
                            <?= Yii::t('common', 'Жаңа шақырту') ?></a>
                        <?php Yii::$app->session->set(
                            'oauthReturnUrl',
                            Url::to(['/invitation/create', 'template' => $invitation->template->slug])
                        ) ?>
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
                            ['/payment/pay', 'orderId' => $invitation?->order?->id, 'returnUrl' => "/{$invitation->url}"],
                        ) ?>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>