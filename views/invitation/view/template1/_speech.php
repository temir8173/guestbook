<?php

/**
 * @var array $fieldValues
 */

?>
<section id="speech" class="speech">
	<div class="container">
		<div class="row">
			<div class="col-md-8" style="position:relative;">
				<div class="speech__text">
					<?= $fieldValues['invite_words'] ?? null ?>
				</div>
				<span class="speech__owners"><?= $fieldValues['wedding_owners'] ?? null ?></span>
			</div>
			<div class="col-md-4">
			</div>
		</div>
	</div>
</section>