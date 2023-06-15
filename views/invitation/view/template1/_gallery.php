<?php

use yii\helpers\Json;

?>
<section id="our-gallery" class="our-gallery">
	<div class="container my-container">
		<div class="row">
			<h2 class="our-gallery__title section-title"><?= $fieldValues['gallery_name'] ?? null ?></h2>
			<div class="address__images restaurant-pic">

				<?php
                $images = Json::decode($fieldValues['gallery_images'] ?? null);
                if (is_array($images)) { ?>
					<?php foreach ($images as $key => $imageName) { ?>
						<div class="col-md-3 col-xs-6">
							<a href="/uploads/<?= $imageName ?>">
						    	<div class="our-gallery__image image-container gallery-horizontal">
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
	</div>
</section>