<?php
use yii\widgets\ActiveForm;
?>

<section>

	<div class="container">
		

		<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

		    <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

		    <button>Submit</button>

		<?php ActiveForm::end() ?>
	</div>	
	
</section>