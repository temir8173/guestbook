<?php

use yii\helpers\Html;

?>

<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <nav class="header-menu">
                    <ul>
                        <?php if (!in_array(Yii::$app->request->url, ['/', '/ru'])) { ?>
                            <li>
                                <?= Html::a(
                                    Yii::t('common', 'Басты бет'),
                                    '/',
                                    [
                                        'class' => 'pink-button',
                                    ]
                                ) ?>
                            </li>
                        <?php } else { ?>
                            <li><a href="#templates"><?= Yii::t('common', 'Үлгілер') ?></a></li>
                            <li><a href="#contacts"><?= Yii::t('common', 'Байланыс') ?></a></li>
                        <?php } ?>
                        <?php if (!Yii::$app->user->isGuest) { ?>
                            <li>
                                <?= Html::a(Yii::t('common', 'Менің шақыруларым'), '/invitations') ?>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
            <div class="col-md-6 d-flex justify-content-between justify-content-md-end">
                <div class="top-phone"><a href="tel:+77773919513">+7 (777) 391-95-13</a></div>
                <div class="lang-switcher">
                    <?php
                    Yii::$app->session->set('tempLocale', Yii::$app->language);
                    if(Yii::$app->language === 'ru') {
                        echo Html::a('Қазақша', array_merge(
                            \Yii::$app->request->get(),
                            ['/'.\Yii::$app->controller->route, 'language' => 'kk']
                        ));
                    }
                    elseif (Yii::$app->language === 'kk') {
                        echo Html::a('Русский', array_merge(
                            \Yii::$app->request->get(),
                            ['/'.\Yii::$app->controller->route, 'language' => 'ru']
                        ));
                    }
                    ?>
                </div>
                <div class="top-phone">
                    <?php if (!Yii::$app->user->identity) { ?>
                        <a href="#" class="" data-bs-toggle="modal" data-bs-target="#modal-login">
                            <?= Yii::t('common', 'Кіру') ?>
                        </a>
                    <?php } else { ?>
                        <?= Yii::$app->user->identity?->username ?>,
                        <?= Html::a(
                            Yii::t('common', 'шығу'),
                            ['auth/logout'],
                        )
                        ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</header>