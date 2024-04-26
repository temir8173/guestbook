<?php

/**
 * @var array $fieldValues
 */

?>
<section id="our-gallery" class="our-gallery">
	<div class="container my-container">
		<div class="row">
			<h2 class="our-gallery__title section-title animate animate-up">
                <?= $fieldValues['gallery_name'] ?? null ?>
            </h2>
        </div>
        <div class="row address__images restaurant-pic">
            <?php if (is_array($fieldValues['gallery_images'])) { ?>
                <?php foreach ($fieldValues['gallery_images'] as $key => $imageName) { ?>
                    <div class="col-12">
                        <a href="/uploads/<?= $imageName ?>">
                            <div class="our-gallery__image image-container gallery-vertical animate animate-out" data-offset="0">
                                <div>
                                    <img src="/uploads/<?= $imageName ?>" alt="<?= $key ?> image">
                                </div>

                            </div>
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>

        </div>
	</div>
</section>