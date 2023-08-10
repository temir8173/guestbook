<?php

use app\models\Template;
use yii\helpers\Html;

/**
 * @var Template[] $templates
*/

$this->title = 'ShaqiruKZ';
?>

<section id="top">
    <div class="container">
        <div class="row">
            <div class="col-md-7 order-2 order-md-1 align-self-end d-flex justify-content-center">
                <div class="top-left-box">
                    <h1>ShaqiruKZ</h1>
                    <p><?= Yii::t('common', 'Интерактивті веб шақыру парақшалары') ?></p>
                    <a class="pink-button" href="#about-product"><?= Yii::t('common', 'Толығырақ') ?></a>
                </div>
            </div>
            <div class="col-md-1 col-0 order-md-2">
            </div>
            <div class="col-md-4 order-1 order-md-3 front-main-image">
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

                    <div class="row justify-content-md-center">
                        <div class="col-md-10">
                            <h2><?= Yii::t('common', 'Шақыру парақшасы деген не?') ?></h2>
                            <p class="mb-5">
                                <?= Yii::t(
                                    'common',
                                    'Бұл - заманауи әрі сәнді нақыштағы қонақтарды шақыруға арналған веб-парақша'
                                )
                                ?>
                            </p>
                            <h2><?= Yii::t(
                                    'common',
                                    'Неліктен веб-парақша?'
                                )
                                ?></h2>
                            <ul>
                                <li><?= Yii::t('common', 'Заманауи') ?></li>
                                <li><?= Yii::t('common', 'Жастар талабына сай') ?></li>
                                <li><?= Yii::t('common', 'Әдемі дизайн') ?></li>
                                <li><?= Yii::t('common', 'Қолжетімді баға') ?></li>
                                <li><?= Yii::t('common', 'Wow-эффект') ?></li>
                                <li><?= Yii::t('common', 'Қонақтармен интерактивті әрекеттесу мүмкіндігі') ?></li>
                            </ul>
                        </div>
                    </div>

                    <?= $this->render('_template_screens_carousel', ['templates' => $templates]) ?>

                </div>

            </div>
        </div>

        <div class="about-bg-bottom section-image">
            <div class="section-inner">
                <?php if (0) { ?>
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
                <?php } ?>
            </div>
        </div>
    </div>

</section>

<?= $this->render('_templates_section', ['templates' => $templates]) ?>

<section id="contacts">
    <div class="container">
        <div class="row">
            <div class="col-12 contacts-box">
                <h2><?= Yii::t('common', 'Байланыс') ?></h2>
                <div class="bottom-rules">
                    <?= Html::a(
                        Yii::t('common', 'Қолдану ережелері'),
                        '/rules',
                    ) ?>
                    <?= Html::a(
                        Yii::t('common', 'Құпиялық саясат'),
                        '/privacy',
                    ) ?>
                </div>
                <div class="social-box">
                    <a target="_blank" rel="noopener noreferrer" href="https://www.instagram.com/shaqiru.kz/"><i class="icon-instagram"></i></a>
                    <a target="_blank" rel="noopener noreferrer"
                       href="https://wa.me/77773919513?text=<?= Yii::t('common', 'Сәлеметсізбе!%20Шақыру%20парағы%20бойынша%20сұрағым%20бар%20еді') ?>">
                        <i class="icon-whatsapp"></i></a>
                    <a target="_blank" rel="noopener noreferrer" href="https://t.me/temir95"><i class="icon-telegram-plane"></i></a>
                </div>
                <a class="bottom-phone" href="tel:+77773919513">+7 (777) 391-95-13</a><br>
                <a class="bottom-phone" href="mailto:shaqirukz@gmail.com">shaqirukz@gmail.com</a><br>
                <span class="bottom-phone">
                    <?= Yii::t(
                        'common',
                        'Орал, Мөңкеұлы 101'
                    ); ?>
                </span>
            </div>
        </div>
    </div>
</section>