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
                    	<span class="top-box__date">19. 06. 2021</span>
                    	<span class="top-box__time">asd</span>
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
				    <a href="upload/restaurants/1.jpg" class="col-md-4" data-caption="Image caption">
				    	<div class="address__image image-container">
			                <div>
			                    <img src="upload/restaurants/1.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
				    <a href="upload/restaurants/2.jpg" class="col-md-4">
				    	<div class="address__image image-container">
			                <div>
			                    <img src="upload/restaurants/2.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
				    <a href="upload/restaurants/3.jpg" class="col-md-4">
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
			<div class="col-sm-12">
				<h2 class="our-gallery__title section-title">Фотогалерея</h2>
				<div class="address__images restaurant-pic">
				    <a href="upload/restaurants/1.jpg" class="col-md-3" data-caption="Image caption">
				    	<div class="address__image image-container">
			                <div>
			                    <img src="upload/restaurants/1.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
				    <a href="upload/restaurants/2.jpg" class="col-md-3">
				    	<div class="address__image image-container">
			                <div>
			                    <img src="upload/restaurants/2.jpg" alt="First image">
			                </div>
			                
			            </div>
				    </a>
				    <a href="upload/restaurants/3.jpg" class="col-md-3">
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

<section id="wishes" class="wishes">
	<div class="container">
		<div class="row">
			<h2 class="wishes__title section-title">Тілек - лебіздеріңіз</h2>
			<div class="col-sm-6">

				<div id="messages-box" class="wishes__messages" data-action-url=<?= Url::to(['/ajax/get-messages']) ?>>
					<?= $this->render('_messages', ['messages' => $messages]); ?>
				</div>

			</div>
			<div class="col-sm-6">

				<?php $form = ActiveForm::begin([
					'action' => Url::to('ajax/add-message'),
	                'enableClientValidation'=>false, 
	                'fieldConfig' => ['options' => ['tag' => false ] ],
	                'options' => [
	                    'class' => 'wishes__form ajax-form',
	                ],
	            ]); ?>

	            	<?= $form->field($newMessage, "name")->textInput(['placeholder' => 'Ваш email', 'class' => 'form-control text required'])->label(false) ?>
	            	<?= $form->field($newMessage, "text")->textArea(['placeholder' => 'Сообщение', 'class' => 'form-control text required', 'rows' => 5])->label(false) ?>
	            	<?= $form->field($newMessage, "date")->hiddenInput(['value' => ''])->label(false) ?>
	            	<?= $form->field($newMessage, "invitation_id")->hiddenInput(['value' => 1])->label(false) ?>

	            	<div class="wishes__form-btn">
	                    <?= Html::submitInput('Құттықтау', ['name' => 'submit', 'class' => 'btn btn-primary']) ?>
	                </div>

	            <?php ActiveForm::end(); ?>

			</div>
		</div>
	</div>
</section>