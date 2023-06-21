<?php

/**
 * @var array $fieldValues
 */

?>
<section id="address" class="address">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<h2 class="address__title section-title"><?= $fieldValues['place_section_name'] ?? null ?></h2>
				<p class="address__place">
                    <?= $fieldValues['place_restaurant'] ?? null ?> <br>
                    <span><?= $fieldValues['place_address'] ?? null ?></span>
                </p>
			</div>
			<div class="col-sm-6">
			<div id="map" class="address__map-container iframe-container"
                 data-coors='<?= $fieldValues['place_map_widget'] ?? null ?>'></div>
			<script src="https://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script>
			<script type="text/javascript">
                let map;
                const coors = document.getElementById('map').getAttribute("data-coors");

                DG.then(function () {
					map = DG.map('map', {
						center: [JSON.parse(coors).lat + 0.001, JSON.parse(coors).lng],
						zoom: 16,
						fullscreenControl: false,
	                    zoomControl: false
					});

					DG.marker(JSON.parse(coors)).addTo(map).bindPopup(
						'<p class="address__place"><?= $fieldValues['place_restaurant'] ?? null ?> <br><span><?= $fieldValues['place_address'] ?? null ?></span></p>'
						).openPopup();
				});
			</script>
				
			</div>
		</div>
        <?php if (0) { ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="address__images restaurant-pic">
                        <?php if (is_array($fieldValues['place_images'])) { ?>
                            <?php foreach ($fieldValues['place_images'] as $key => $imageName) { ?>
                                <a href="/uploads/<?= $imageName ?>" class="col-sm-4" data-caption="">
                                    <div class="address__image image-container">
                                        <div>
                                            <img src="/uploads/<?= $imageName ?>" alt="<?= $key ?>-image">
                                        </div>

                                    </div>
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
	</div>
</section>