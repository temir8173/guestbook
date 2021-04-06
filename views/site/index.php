<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = 'Гостевая книга';
?>
<section id="input">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
            	<?php $form = ActiveForm::begin([
	                'enableClientValidation'=>false, 
	                'fieldConfig' => ['options' => ['tag' => false ] ],
	                'options' => [
	                    'class' => 'rating_form ajax-form'
	                 ]
	            ]); ?>

	            	<?= $form->field($newMessage, "name")->textInput(['placeholder' => 'Ваш email', 'class' => 'form-control text required'])->label(false) ?>
	            	<?= $form->field($newMessage, "text")->textInput(['placeholder' => 'Сообщение', 'class' => 'form-control text required'])->label(false) ?>
	            	<?= $form->field($newMessage, "date")->hiddenInput(['value' => ''])->label(false) ?>
	            	<?= $form->field($newMessage, "invitation_id")->hiddenInput(['value' => 1])->label(false) ?>

	            	<div class="inline__anteta1-btn input__btn-update">
	                    <?= Html::submitInput('Отправить результаты', ['name' => 'submit', 'class' => 'btn btn-primary']) ?>
	                </div>

	            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>  

<section id="messages-result">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div id="messages-box" data-action-url=<?= Url::to(['/ajax/messages']) ?>>
					<?= $this->render('_messages', ['messages' => $messages]); ?>
				</div>
			</div>
		</div>
	</div>
</section>