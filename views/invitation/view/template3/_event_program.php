<?php

/**
 * @var array $fieldValues
 */

use yii\helpers\Json;

?>
<section id="love-story" class="love-story">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="love-story__title section-title animate animate-up">
                    <?= $fieldValues['event_title'] ?? null ?>
                </h2>
                <?php
                    $eventItems = $fieldValues['event_items'];
                    $eventItems = Json::decode($eventItems);
                ?>
                <div class="event-program-box">
                    <ul class="event-program">
                        <?php if (is_array($eventItems)) { ?>
                            <?php foreach ($eventItems as $eventItem) { ?>
                                <li class="animate animate-long_right">
                                    <span class="event-time"><?= $eventItem['time'] ?></span>
                                    <span class="event-name"><?= $eventItem['name'] ?></span>
                                    <?php if (isset($eventItem['address'])) { ?>
                                        <span class="event-address"><?= $eventItem['address'] ?></span>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>