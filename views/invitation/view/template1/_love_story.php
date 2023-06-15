<section id="love-story" class="love-story">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2 class="love-story__title section-title">
                    <?= $fieldValues['lovestory_section_name'] ?? null ?>
                </h2>
				<div class="love-story__video-container iframe-container">
					<iframe width="100%" height="500px" src="
					<?= $fieldValues['lovestory_video_url'] ?>"
                            title="YouTube video player"
                            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
				</div>
			</div>
		</div>
	</div>
</section>