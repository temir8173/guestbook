<section id="our-gallery" class="our-gallery">
	<div class="container my-container">
		<div class="row">
			<h2 class="our-gallery__title section-title"><?= $section->getFieldValueByUrl('gallery-name') ?></h2>
			<div class="address__images restaurant-pic">

				<?php if ( is_array($section->getFieldValueByUrl('gallery-images')) ) { ?>
					<?php foreach ($section->getFieldValueByUrl('gallery-images') as $key => $imageName) { ?>
						<div class="col-md-3 col-xs-6">
							<a href="/uploads/<?= $imageName ?>">
						    	<div class="our-gallery__image image-container gallery-horizontal">
					                <div>
					                    <img src="/uploads/<?= $imageName ?>" alt="First image">
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