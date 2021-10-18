<?php

use yii\helpers\Html;

?>
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <nav class="header-menu">
                    <ul>
                        <li><a href="#">Каталог</a></li>
                        <li><a href="#">Доставка</a></li>
                        <li><a href="#contacts">Контакты</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-6">
                <div class="top-phone"><a href="tel:+77773919513">+7 (777) 391-95-13</a></div>
            </div>
        </div>
    </div>
</header>

<section id="top">
    <div class="container">
        <div class="row">
            <div class="col-md-4  align-self-end">
                <div class="top-left-box">
                    <h1>ShaqiruKZ</h1>
                    <p><?= Yii::t('common', 'Шақыру парақшалары') ?></p>
                    <a href="#"><?= Yii::t('common', 'Толығырақ') ?></a>
                </div>
            </div>
            <div class="col-md-8">
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

                    <div class="row mb-5">
                        <h2><?= Yii::t('common', 'Шақыру парақшасы дегеніміз не?') ?></h2>
                        <p>dfgsdfgsdfgsdfgsdfgsdfg</p>
                    </div>



                    <div class="row about-row">
                        <div class="col-md-6">
                            <div class="img-container">
                                <img src="images/front-top.png" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-between">
                            <div class="about-box-text">
                                <p class="about-title"><?= Yii::t('common', 'Шақыру парақшасы - бұл жақсы нәрсе') ?></p>
                                <p><?= Yii::t('common', 'Шақыру парағы - келе жатқан той-жиынға қонақтарды шақыру үшін арналған интернет-парақшалар. 
                                Қарапайым, дәстүрлі шақыру билеттерінен басты айырмашылығы - бұл сайт-парақша түрінде болуы')
                                    ?></p>

                            </div>
                            <div class="about-box-position d-flex justify-content-end">

                                <span class="about-box-number">01</span>
                            </div>
                        </div>
                    </div>



                    <div class="row about-row">


                        <div class="col-md-6 d-flex flex-column justify-content-between">
                            <div class="about-box-text">
                                <p class="about-title"><?= Yii::t('common', 'Шақыру парақшасы - бұл жақсы нәрсе') ?></p>
                                <p><?= Yii::t('common', 'Қазіргі таңда') ?></p>

                            </div>
                            <div class="about-box-position  d-flex justify-content-start">

                                <span class="about-box-number ">02</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="img-container">
                                <img src="images/about1.png" alt="">
                            </div>
                        </div>
                    </div>



                    <div class="row about-row">
                        <div class="col-md-6">
                            <div class="img-container">
                                <img src="images/about2.png" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-between">
                            <div class="about-box-text">
                                <p class="about-title"><?= Yii::t('common', 'Шақыру парақшасы - бұл жақсы нәрсе') ?></p>
                                <p><?= Yii::t('common', 'Шақыру парағы - келе жатқан той-жиынға қонақтарды шақыру үшін арналған интернет-парақшалар. 
                                Қарапайым, дәстүрлі шақыру билеттерінен басты айырмашылығы - бұл сайт-парақша түрінде болуы')
                                    ?></p>

                            </div>
                            <div class="about-box-position d-flex justify-content-end">

                                <span class="about-box-number">03</span>
                            </div>
                        </div>
                    </div>

                    <div class="row about-row">


                        <div class="col-md-6 d-flex flex-column justify-content-between">
                            <div class="about-box-text">
                                <p class="about-title"><?= Yii::t('common', 'Love story') ?></p>
                                <p><?= Yii::t('common', 'Сондай-ақ видео қою мүмкіндігі бар') ?></p>

                            </div>
                            <div class="about-box-position  d-flex justify-content-start">

                                <span class="about-box-number ">04</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="img-container">
                                <img src="images/about3.png" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="row about-row">
                        <div class="col-md-6">
                            <div class="img-container">
                                <img src="images/about4.png" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-between">
                            <div class="about-box-text">
                                <p class="about-title"><?= Yii::t('common', 'Тілектер') ?></p>
                                <p><?= Yii::t('common', 'Сондай-ақ видео қою мүмкіндігі бар') ?></p>

                            </div>
                            <div class="about-box-position d-flex justify-content-end">

                                <span class="about-box-number">05</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>

<section id="shaqiru-templates">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2><?= Yii::t('common', 'Шақыру үлгілері') ?></h2>
                <p><?= Yii::t('common', 'Біз шақыру парақшаларының бірнеше үлгісін ұсынамыз. 
                Сіз бір үлгіні таңдай отырып сол үлгі негізінде шақыру парақшасын ала аласыз') ?></p>
                <?= Html::a(Yii::t('common', 'Үлілерді көру'), '/templates') ?>
            </div>
        </div>
    </div>
</section>