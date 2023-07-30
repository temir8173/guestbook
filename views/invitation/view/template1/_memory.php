<?php

/**
 * @var array $fieldValues
 */

use app\helpers\CloudServiceHelper;

?>
<section id="afterwards" class="afterwards">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="afterwards__title section-title section-story title">Тойдан қалған естелік</h2>
                <div class="download-card">
                    <div class="download-list d-flex justify-content-around text-center">
                        <?= $this->render('_memory_item', ['url' => $fieldValues['memory_links'] ?? null]); ?>
                        <?= $this->render('_memory_item', ['url' => $fieldValues['memory_link2'] ?? null]); ?>
                        <?= $this->render('_memory_item', ['url' => $fieldValues['memory_link3'] ?? null]); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>