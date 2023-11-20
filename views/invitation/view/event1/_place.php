<?php

/**
 * @var array $fieldValues
 */

?>
<section id="address" class="address">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="address__title section-title animate animate-down">
                    <?= $fieldValues['place_section_name'] ?? null ?>
                </h2>
				<div class="address__place">
                    <p class="animate animate-right"><?= $fieldValues['place_restaurant'] ?? null ?></p>
                    <p class="animate animate-left"><?= $fieldValues['place_address'] ?? null ?></p>
                    <?php if(isset($fieldValues['place_link']) && $fieldValues['place_link']) { ?>
                        <a target="_blank" href="<?= $fieldValues['place_link'] ?>">
                            2GIS
                        </a>
                    <?php } ?>
                </div>
			</div>
			<div class="col-12 d-flex align-items-end">
			<div id="map" class="address__map-container iframe-container animate animate-up"
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
						'<div class="address__place address__place-popup"><p><?= $fieldValues['place_restaurant'] ??
                        null ?></p><span><?=
                            $fieldValues['place_address'] ?? null ?></span></div>'
						).openPopup();
				});
			</script>
				
			</div>
		</div>
	</div>
</section>