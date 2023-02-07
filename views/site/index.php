<?php

use yii\helpers\Html;

?>
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <nav class="header-menu">
                    <ul>
                        <li><a href="#about-product"><?= Yii::t('common', 'Біз туралы') ?></a></li>
                        <li><a href="#contacts"><?= Yii::t('common', 'Байланыс') ?></a></li>
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

<section id="top">
    <div class="container">
        <div class="row">
            <div class="col-md-4 order-2 order-md-1 align-self-end">
                <div class="top-left-box">
                    <h1>ShaqiruKZ</h1>
                    <p><?= Yii::t('common', 'Көз аларлық шақыру парақшалары') ?></p>
                    <a class="pink-button" href="#about-product"><?= Yii::t('common', 'Толығырақ') ?></a>
                </div>
            </div>
            <div class="col-md-8 order-1 order-md-2">
                <div class="img-container">
                    <img src="images/front-top.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about-product">
    <div class="about-bg-container">
        <div class="about-bg section-image">
            <div class="section-inner">

                <div class="container">

                    <div class="row">
                        <h2><?= Yii::t('common', 'Шақыру парақшасы деген не?') ?></h2>
                        <ul>
                            <li>
                                <?= Yii::t(
                                    'common',
                                    'Бұл - заманауи әрі сәнді нақыштағы қонақтарды шақыру үшін
                                             арналған веб-парақша'
                                )
                                ?>
                            </li>
                            <li>
                                <?= Yii::t(
                                    'common',
                                    'Неліктен веб-парақша? Себебі веб-парақшасының келесідей артықшылықтары бар'
                                )
                                ?>
                            </li>
                        </ul>
                        <p class="about-list-title">
                            <?= Yii::t(
                                'common',
                                'Веб-парақшаға орналастыруға болатын мағлұматтар тізімі: '
                            )
                            ?>
                        </p>
                    </div>



                    <div class="row about-row">

                        <div class="col-md-7">
                            <div class="img-container">
                                <img src="images/about1.png" alt="">
                            </div>
                        </div>


                        <div class="col-md-5 d-flex flex-column justify-content-end">
                            <div class="about-box-text">
                                <p class="about-title"><?= Yii::t('common', 'Өткізілетін орын') ?></p>
                                <p>
                                    <?= Yii::t(
                                        'common',
                                        'Жиынның өткізілетін жері туралы мағлұмат орнастыру мүмкіндігі'
                                    )
                                    ?>
                                </p>
                            </div>
                            <div class="about-box-position  d-flex justify-content-end">
                                <span class="about-box-number ">01</span>
                            </div>
                        </div>
                    </div>



                    <div class="row about-row">
                        <div class="col-md-7 order-md-2">
                            <div class="img-container">
                                <img src="images/about2.png" alt="">
                            </div>
                        </div>
                        <div class="col-md-5 order-md-1 d-flex flex-column justify-content-end">
                            <div class="about-box-text about-box-left">
                                <p class="about-title"><?= Yii::t('common', 'Естелік') ?></p>
                                <p>
                                    <?= Yii::t(
                                            'common',
                                            'Тойдан көптеген естеліктер қалады емес пе? Қонақтар осы парақша 
                                            арқылы бейне/фото материалдарға қол жеткізе алады'
                                    )
                                    ?>
                                </p>

                            </div>
                            <div class="about-box-position d-flex justify-content-start">

                                <span class="about-box-number">02</span>
                            </div>
                        </div>
                    </div>

                    <div class="row about-row">

                        <div class="col-md-7">
                            <div class="img-container">
                                <img src="images/about3.png" alt="">
                            </div>
                        </div>

                        <div class="col-md-5 d-flex flex-column justify-content-end">
                            <div class="about-box-text">
                                <p class="about-title"><?= Yii::t('common', 'Love story') ?></p>
                                <p><?= Yii::t('common', 'Сондай-ақ өміріңіздегі ұмытылмас сәттеріңізбен жақын-жуықтарыңызбен бөлісе аласыз') ?></p>

                            </div>
                            <div class="about-box-position  d-flex justify-content-end">

                                <span class="about-box-number ">03</span>
                            </div>
                        </div>
                    </div>

                    <div class="row about-row mb-0">
                        <div class="col-md-7 order-md-2">
                            <div class="img-container">
                                <img src="images/about4.png" alt="">
                            </div>
                        </div>
                        <div class="col-md-5 order-md-1 d-flex flex-column justify-content-end">
                            <div class="about-box-text about-box-left">
                                <p class="about-title"><?= Yii::t('common', 'Тілектер') ?></p>
                                <p><?= Yii::t('common', 'Қонақтар өздерінің тілек-лебіздерін білдіре алады') ?></p>

                            </div>
                            <div class="about-box-position d-flex justify-content-start">

                                <span class="about-box-number">04</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="about-bg-bottom section-image">
            <div class="section-inner">
                <div class="container">
                    <div class="row">
                        <?= Html::a(
                            Yii::t('common', 'Үлгілерге өту'),
                            'templates',
                            [
                                'class' => 'pink-button',
                            ]
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<section id="contacts">
    <div class="container">
        <h2><?= Yii::t('common', 'Байланыс') ?></h2>
        <a class="bottom-phone" href="tel:+77773919513">+7 (777) 391-95-13</a>
        <div class="social-box">
            <a target="_blank" rel="noopener noreferrer" href="https://www.instagram.com/shaqiru.kz/"><i class="icon-instagram"></i></a>
            <a target="_blank" rel="noopener noreferrer"
            href="https://wa.me/77773919513?text=<?= Yii::t('common', 'Сәлеметсізбе!%20Шақыру%20парағы%20бойынша%20сұрағым%20бар%20еді') ?>">
            <i class="icon-whatsapp"></i></a>
            <a target="_blank" rel="noopener noreferrer" href="https://t.me/temir95"><i class="icon-telegram-plane"></i></a>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <p class="pull-left"></p>
        <p class="pull-right footer-title">© ShaqiruKZ 2023</p>
    </div>
</footer>