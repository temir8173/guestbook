<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = 'Гостевая книга';
?>

<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="top-box">
                    <h1 class="top-box__title">Руслан<br>Үйлену той</h1>
                    <div class="top-box__row">

                    	<div id="countdown" class="top-box__time countdown">
							<div class="countdown-number">
								<span class="days countdown-time"></span>
								<span class="countdown-text">Күн</span>
							</div>
							<div class="countdown-number">
								<span class="hours countdown-time"></span>
								<span class="countdown-text">Сағат</span>
							</div>
							<div class="countdown-number">
								<span class="minutes countdown-time"></span>
								<span class="countdown-text">Минут</span>
							</div>
							<div class="countdown-number">
								<span class="seconds countdown-time"></span>
								<span class="countdown-text">Секунд</span>
							</div>
						</div>
						<div id="deadline-message" class="deadline-message">
						
						</div>

                    	<span class="top-box__date">19. 06. 2021</span>
                    </div>
                    <a href="#speech" class="top-box__arrow scrollto"> <!--&#11167;-->
						<img class="top-box__arrow-img" src="http://new.wkau.kz/wp-content/themes/wkau-theme/assets/images/digital-un/angle-arrow-pointing-down.svg" alt="...">
					</a>
                </div>
            </div>
        </div>
    </div>
</header>

<section id="speech" class="speech">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<p class="speech__text">
					Привет нашим родным и друзьям!
					Ждём вас на нашем главном торжестве, ведь мы решили собрать только самых родных и близких, с кем хотим поделиться своим счастьем.
					И с вашего разрешения, чтобы сделать вечер интересным и лёгким. Мы хотим сделать наше мероприятие без традиционных тостов. Для всех гостей у нас есть зона видео поздравлений.
					Обязательно посмотрите фотографии с нашей свадьбы!
				</p>
				<span class="speech__owners">Той иелері: </span>
			</div>
			<div class="col-sm-6">
			</div>
		</div>
	</div>
</section>

<section id="love-story" class="love-story">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2 class="love-story__title section-title">Love story</h2>
				<div class="love-story__video-container iframe-container">
					<iframe width="100%" height="500px" src="https://www.youtube.com/embed/qwCmhIeSRhM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="address" class="address">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<h2 class="address__title section-title">Өткізу орны</h2>
				<p class="address__place">Махаббат тойханасы <br><span>Еуразия даңғылы, 120</span></p>
			</div>
			<div class="col-sm-6">
				<div class="address__map-container iframe-container">
					<a class="dg-widget-link" href="http://2gis.kz/uralsk/firm/70000001025294321/center/51.35923862457276,51.22236764552972/zoom/16?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=bigMap">Посмотреть на карте Уральска</a><div class="dg-widget-link"><a href="http://2gis.kz/uralsk/firm/70000001025294321/photos/70000001025294321/center/51.35923862457276,51.22236764552972/zoom/17?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=photos">Фотографии компании</a></div><div class="dg-widget-link"><a href="http://2gis.kz/uralsk/center/51.358037,51.222378/zoom/16/routeTab/rsType/bus/to/51.358037,51.222378╎Махаббат, комплекс?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=route">Найти проезд до Махаббат, комплекс</a></div><script charset="utf-8" src="https://widgets.2gis.com/js/DGWidgetLoader.js"></script><script charset="utf-8">new DGWidgetLoader({"width":640,"height":400,"borderColor":"#a3a3a3","pos":{"lat":51.22236764552972,"lon":51.35923862457276,"zoom":16},"opt":{"city":"uralsk"},"org":[{"id":"70000001025294321"}]});</script><noscript style="color:#c00;font-size:16px;font-weight:bold;">Виджет карты использует JavaScript. Включите его в настройках вашего браузера.</noscript>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="address__images restaurant-pic">
				    <a href="upload/restaurants/1.jpg" class="col-sm-4" data-caption="Image caption">
				    	<div class="address__image image-container">
			                <div>
			                    <img src="upload/restaurants/1.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
				    <a href="upload/restaurants/2.jpg" class="col-sm-4">
				    	<div class="address__image image-container">
			                <div>
			                    <img src="upload/restaurants/2.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
				    <a href="upload/restaurants/3.jpg" class="col-sm-4">
				    	<div class="address__image image-container">
			                <div>
			                    <img src="upload/restaurants/3.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="afterwards" class="afterwards">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2 class="afterwards__title section-title">Тойдан қалған естелік</h2>
				<p>! Бұл жерде тойда түсірілген фото және бейне материалдары көре аласыз</p>
			</div>
		</div>
	</div>
</section>

<section id="our-gallery" class="our-gallery">
	<div class="container my-container">
		<div class="row">
			<h2 class="our-gallery__title section-title">Фотогалерея</h2>
			<div class="address__images restaurant-pic">

				<div class="col-md-2 col-xs-4 b1">
					<a href="upload/gallery/1.jpg">
				    	<div class="our-gallery__image image-container gallery-vertical">
			                <div>
			                    <img src="upload/gallery/1.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
					<a href="upload/gallery/2.jpg" >
				    	<div class="our-gallery__image image-container gallery-vertical">
			                <div>
			                    <img src="upload/gallery/2.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
				</div>

				<div class="col-md-3 col-xs-6 b2">
					<a href="upload/gallery/3.jpg">
				    	<div class="our-gallery__image image-container gallery-horizontal">
			                <div>
			                    <img src="upload/gallery/3.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
					<a href="upload/gallery/4.jpg">
				    	<div class="our-gallery__image image-container gallery-horizontal">
			                <div>
			                    <img src="upload/gallery/4.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
					<a href="upload/gallery/5.jpg">
				    	<div class="our-gallery__image image-container gallery-horizontal">
			                <div>
			                    <img src="upload/gallery/5.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
				</div>

				<div class="col-md-2 col-xs-4 b3">
					<a href="upload/gallery/6.jpg" >
				    	<div class="our-gallery__image image-container gallery-vertical">
			                <div>
			                    <img src="upload/gallery/6.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
					<a href="upload/gallery/7.jpg" >
				    	<div class="our-gallery__image image-container gallery-vertical">
			                <div>
			                    <img src="upload/gallery/7.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
				</div>

				<div class="col-md-3 col-xs-6 b4">
					<a href="upload/gallery/8.jpg">
				    	<div class="our-gallery__image image-container gallery-horizontal">
			                <div>
			                    <img src="upload/gallery/8.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
					<a href="upload/gallery/9.jpg">
				    	<div class="our-gallery__image image-container gallery-horizontal">
			                <div>
			                    <img src="upload/gallery/9.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
					<a href="upload/gallery/10.jpg">
				    	<div class="our-gallery__image image-container gallery-horizontal">
			                <div>
			                    <img src="upload/gallery/10.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
				</div>

				<div class="col-md-2  col-xs-4 b5">
					<a href="upload/gallery/11.jpg" >
				    	<div class="our-gallery__image image-container gallery-vertical">
			                <div>
			                    <img src="upload/gallery/11.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
					<a href="upload/gallery/12.jpg" >
				    	<div class="our-gallery__image image-container gallery-vertical">
			                <div>
			                    <img src="upload/gallery/12.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
				</div>

			</div>
		</div>
	</div>
</section>

<section id="wishes" class="wishes">
	<div class="container">
		<div class="row">
			<h2 class="wishes__title section-title">Тілек - лебіздеріңіз</h2>
			<div class="col-sm-6">

				<div class="wishes__messages">
					<div id="messages-box" data-action-url=<?= Url::to(['/invitations/default/get-messages']) ?>>
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
	            	<?= $form->field($newMessage, "invitation_id")->hiddenInput(['value' => 1])->label(false) ?>

	            	<div class="wishes__form-btn">
	                    <?= Html::submitInput('Құттықтау', ['name' => 'submit', 'class' => 'btn']) ?>
	                </div>

	            <?php ActiveForm::end(); ?>

			</div>
		</div>
	</div>
</section>