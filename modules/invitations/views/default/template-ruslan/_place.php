<section id="address" class="address">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<h2 class="address__title section-title"><?= $section->getFieldValueByUrl('place-section-name') ?></h2>
				<p class="address__place"><?= $section->getFieldValueByUrl('place-restaurant') ?> <br><span><?= $section->getFieldValueByUrl('place-address') ?></span></p>
			</div>
			<div class="col-sm-6">
			<div id="map" class="address__map-container iframe-container"></div>
			<script src="https://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script>
			<script type="text/javascript">
				var map;

				DG.then(function () {
					map = DG.map('map', {
						center: [51.23, 51.38],
						zoom: 11
					});

					DG.marker([51.23, 51.38]).addTo(map).bindPopup('Мерейтой Орал қаласында өтеді');
				});
			</script>
				
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="address__images restaurant-pic">
					<?php if ( is_array($section->getFieldValueByUrl('place-images')) ) { ?>
						<?php foreach ($section->getFieldValueByUrl('place-images') as $key => $imageName) { ?>
						    <a href="/uploads/<?= $imageName ?>" class="col-sm-4" data-caption="">
						    	<div class="address__image image-container">
					                <div>
					                    <img src="/uploads/<?= $imageName ?>" alt="First image">
					                </div>
					                
					            </div>
						    </a>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>