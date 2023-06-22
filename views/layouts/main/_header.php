<?php

use yii\helpers\Html;

?>

<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <nav class="header-menu">
                    <ul>
                        <li>
                            <?= Html::a(
                                Yii::t('common', 'Басты бет'),
                                '/',
                                [
                                    'class' => 'pink-button',
                                ]
                            ) ?>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-6 d-flex justify-content-between justify-content-md-end">
                <div class="lang-switcher">
                    <?php
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
                <div class="top-phone"><a href="tel:+77773919513">+7 (777) 391-95-13</a></div>
            </div>
        </div>
    </div>
</header>