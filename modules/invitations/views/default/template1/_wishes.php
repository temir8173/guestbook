<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>
<section id="wishes" class="wishes">
	<div class="container">
		<div class="row">
			<h2 class="wishes__title section-title">Тілек - лебіздеріңіз</h2>
			<div class="col-sm-6">

				<div class="wishes__messages">
					<div id="messages-box" data-action-url="<?= Url::to(['/invitations/default/get-messages', 'invitation_id' => $invitation->id]) ?>">
						<?= $this->render('_messages', ['messages' => $messages]); ?>
					</div>
				</div>

			</div>
			<div class="col-sm-6">

				<?php $form = ActiveForm::begin([
					'action' => Url::to('/invitations/default/add-message'),
	                'enableClientValidation'=>false, 
	                'options' => [
	                    'class' => 'wishes__form ajax-form',
	                ],
	            ]); ?>

	            	<?= $form->field($newMessage, "name")->textInput([
	            		'placeholder' => Yii::t('common', 'Атыңыз'), 
	            		'class' => 'form-control text required',
	            		'data' => [
	            			'error-msg' => Yii::t('common', 'Міндетті түрде тотыру қажет'),
	            		],
	            	])->label(false) ?>
	            	<?= $form->field($newMessage, "text")->textArea([
	            		'placeholder' => Yii::t('common', 'Тілегіңіз'), 
	            		'class' => 'form-control text required', 
	            		'rows' => 5,
	            		'data' => [
	            			'error-msg' => Yii::t('common', 'Міндетті түрде тотыру қажет'),
	            		],
	            	])->label(false) ?>
	            	<?= $form->field($newMessage, "date")->hiddenInput(['value' => ''])->label(false) ?>
	            	<?= $form->field($newMessage, "invitation_id")->hiddenInput(['value' => $invitation->id])->label(false) ?>

	            	<div class="wishes__form-btn">
	                    <?= Html::submitInput('Құттықтау', ['name' => 'submit', 'class' => 'btn']) ?>
	                </div>

	            <?php ActiveForm::end(); ?>

			</div>
		</div>
	</div>
</section>