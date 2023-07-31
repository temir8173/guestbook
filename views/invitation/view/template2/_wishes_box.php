<?php

use app\models\Wish;
use yii\helpers\Html;

/**
 * @var Wish[] $wishes
 */

?>

<div class="news__items notif__items" >

    <?php foreach ($wishes as $wish) { ?>

        <div class="default-block__content default-block__content_most-read" >
            <ul class="content-list content-list_most-read"> 
                <li class="content-list__item content-list__item_devided post-info">
                    <div class="post-info__title" ><span><?= Html::encode($wish->name) ?></span></div>
                    <div class="post-info__text" ><span><?= Html::encode($wish->text) ?></span></div>
                    <div class="post-info__meta">
                        <span class="post-info__meta-item">
                            <span class="post-info__meta-counter post-info__meta-counter_small" >
                                <?= Yii::$app->formatter->asDate($wish->created_at, 'php:d.m.Y'); ?>
                            </span>
                        </span>
                    </div>
                </li>
                
                  
              </ul>
        </div>

    <?php } ?>

</div>