<?php

use app\lists\GuestAnswersList;
use app\models\Invitation;
use app\models\Wish;
use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var Invitation $invitation
 * @var Wish $newMessage
*/

?>
<section id="wishes" class="wishes">
	<div class="container">
		<div class="row  justify-content-center">
			<h2 class="wishes__title section-title animate animate-up"><?= $fieldValues['wishes_name'] ?? null ?></h2>
			<div class="col-md-9 wish-first-col">

				<div class="wishes__messages animate animate-out" data-offset="-300">
					<div id="messages-box"
                         data-action-url="<?= Url::to([
                             '/invitation/get-wishes',
                             'invitationId' => $invitation->id
                         ]) ?>">
                        <?= $this->render('_wishes_box', ['wishes' => $invitation->wishes]); ?>
					</div>
				</div>

			</div>
			<div class="col-md-9">

				<?php $form = ActiveForm::begin([
					'action' => Url::to('/invitation/add-wish'),
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
	            	<?= $form->field($newMessage, "answer")->dropDownList(GuestAnswersList::getAll(), [
	            		'class' => 'form-control text required',
	            		'data' => [
	            			'error-msg' => Yii::t('common', 'Міндетті түрде тотыру қажет'),
	            		],
	            	])->label(Yii::t('common', 'Тойға келесіз бе?')) ?>
                    <?= $form->field($newMessage, 'reCaptcha')
                        ->widget(ReCaptcha2::class, []) ?>

	            	<?= $form->field($newMessage, "date")->hiddenInput(['value' => ''])->label(false) ?>
	            	<?= $form->field($newMessage, "invitation_id")->hiddenInput(['value' => $invitation->id])->label(false) ?>

	            	<div class="wishes__form-btn">
	                    <?= Html::submitInput(
                            Yii::t('common', 'Құттықтау'),
                            ['name' => 'submit', 'class' => 'btn']
                        ) ?>
	                </div>

	            <?php ActiveForm::end(); ?>

			</div>
		</div>
	</div>
</section>