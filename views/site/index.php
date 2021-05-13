<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
?>

<header id="header">

	<div class="top-menu">
		<div class="container">
			<div class="row">
				<div class="col-xs-4 col-sm-8">
					<a href="/" class="top-logo">SHAQIRU.KZ</a>
					<!-- <a href="tel:+77078758173" class="top-phone">+7 707 875 8173</a> -->
				</div>
				<div class="col-xs-8 col-sm-4">
					<div class="header__lang pull-right">
						<div class="lang__list">
							<div class="lang__item">
								<?= Html::a('<img src="/images/kazakhstan.png" alt="">', array_merge(
									\Yii::$app->request->get(),
									['/'.\Yii::$app->controller->route, 'language' => 'kk']
								)); ?>
							</div>
							<div class="lang__item">
								<?= Html::a('<img src="/images/russia.png" alt="">', array_merge(
									\Yii::$app->request->get(),
									['/'.\Yii::$app->controller->route, 'language' => 'ru']
								)); ?>
							</div>
						</div>  
					</div>
					<span class="top-cabinet ">
						<a href="<?= Url::to(['manage/invitations']) ?>" class=""><?= Yii::t('common', 'Жеке кабинет') ?></a>
					</span>
				</div>
			</div>
		</div>
	</div>

	<div class="container">

		<h1 class="front-title"><?= Yii::t('common', 'Онлайн шақыру билеттері') ?></h1>

	</div>	
	
</header>