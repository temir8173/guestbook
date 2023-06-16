<?php

use app\models\Wish;
use yii\helpers\Html;

/**
 * @var Wish[] $messages
 */

?>

<div class="news__items notif__items" >

    <?php foreach ( $messages as $message ) : ?>

        <div class="default-block__content default-block__content_most-read" >
            <ul class="content-list content-list_most-read"> 
                <li class="content-list__item content-list__item_devided post-info">
                    <div class="post-info__title" ><span><?= Html::encode($message->name) ?></span></div>
                    <div class="post-info__text" ><span><?= Html::encode($message->text) ?></span></div>
                    <div class="post-info__meta">
                        <span class="post-info__meta-item">
                            <span class="post-info__meta-counter post-info__meta-counter_small" ><?= Yii::$app->formatter->asDate($message->date, 'php:d.m.Y'); ?></span>
                        </span>
                    </div>
                </li>
                
                  
              </ul>
        </div>

    <?php endforeach; ?>

</div>