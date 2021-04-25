<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<header id="header">

	<div class="top-menu">
		<div class="container">
			<div class="row">
				<div class="col-xs-8">
					<a href="/" class="top-logo">SHAQIRU.KZ</a>
					<a href="tel:+77078758173" class="top-phone">+7 707 875 8173</a>
				</div>
				<div class="col-xs-4">
					<span class="top-cabinet ">
						<a href="<?= Url::to(['manage/invitations']) ?>" class="pull-right">Жеке кабинет</a>
					</span>
				</div>
			</div>
		</div>
	</div>

	<div class="container">

		<h1 class="front-title">Онлайн шақыру парақшалары</h1>

	</div>	
	
</header>