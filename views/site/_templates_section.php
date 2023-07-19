<?php

use app\lists\TemplateTypesList;
use app\models\Template;
use yii\helpers\Url;

$templateTypes = TemplateTypesList::getAll();

/**
 * @var Template[][] $templates
 */

?>

<section id="templates">
    <div class="about-bg-container">
        <div class="about-bg section-image">
            <div class="section-inner">

                <div class="container">

                    <div class="row">
                        <div class="col-12">
                            <h2><?= Yii::t('common', 'Үлгілер') ?></h2>

                            <ul class="nav nav-tabs" id="templates-tab" role="tablist">
                                <?php foreach ($templateTypes as $slug => $templateType) { ?>
                                    <li class="nav-item service-tag" role="presentation">
                                        <button class="nav-link <?= ($slug === TemplateTypesList::MARRIAGE) ? 'active' : '' ?>"
                                                id="service-cat-<?= $slug ?>-tab" data-bs-toggle="tab"
                                                data-bs-target="#service-cat-<?= $slug ?>" type="button" role="tab" aria-controls="home" aria-selected="false">

                                            <?= $templateType ?>
                                        </button>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>


                        <div class="tab-content">

                            <?php foreach ($templateTypes as $typeSlug => $templateType) { ?>
                            <div class="services-tab tab-pane <?= ($typeSlug === TemplateTypesList::MARRIAGE) ? 'active' : '' ?>"
                                 id="service-cat-<?= $typeSlug ?>" role="tabpanel"
                                 aria-labelledby="service-cat-<?= $typeSlug ?>-tab">

                                <div class="container" style="padding: 0">
                                    <div class="row product-grid-style">
                                        <?php
                                        /** @var Template $template */
                                        $templatesBySpecificType = $templates[$typeSlug] ?? [];
                                        ?>
                                        <?php foreach ($templatesBySpecificType as $template) { ?>
                                            <div class="col-12 col-sm-6 col-lg-4">
                                                <div class="product-details">
                                                    <a href="<?= Url::to(['/invitation/view', 'url' => $template->slug]) ?>"
                                                       class="product-img">
                                                        <?php if ($template->discount_price) { ?>
                                                            <div class="label-offer bg-red">Sale</div>
                                                        <?php } ?>
                                                        <div class="img-box img-container">
                                                            <div>
                                                                <img src="<?= $template->previewImage ?>" alt="...">
                                                            </div>
                                                        </div>
                                                        <div href="#" class="product-info">
                                                            <span><?= $template->name ?></span>
                                                            <p class="price text-center m-0">
                                                                <?php if ($template->discount_price) { ?>
                                                                    <span class="red line-through me-1"><?= $template->price ?>₸</span>
                                                                    <span><?= $template->discount_price ?>₸</span>
                                                                <?php } else { ?>
                                                                    <span><?= $template->price ?>₸</span>
                                                                <?php } ?>
                                                            </p>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>