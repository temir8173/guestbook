<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = $invitation->name;
?>




<header class="header d-flex flex-wrap align-content-center text-center">
 <div class="header-bg d-flex flex-wrap align-content-center">

 

 <div class="container">

  <div class="wedding-name">
   <div class="wedding-name-list">
    <div class="wedding-name-items">Набат</div>
    <div class="wedding-name-items">
     <img class="wedding-name-items-img" src="./images/infinite-2.png" alt="">
    </div>
    <div class="wedding-name-items">Гулайхан</div>
    
   </div>
<!--  <div class="wedding-name-text">23.10.2021</div>-->
   <div class="wedding-date text-center m-auto">
    <div class="wedding-date-top">Қазан</div>
    <div class="wedding-date-center">
     <div class="wedding-date-item left">Сенбі</div>
     <div class="wedding-date-item center">23</div>
     <div class="wedding-date-item right">18:00</div>

    </div>

    <div class="wedding-date-bottom">2021</div>
   </div>
  </div>


 </div>
</div>
</header>


<?php foreach ($invitation->sections as $section) : ?>

	<?php if ($section->status == 1) : ?>

		<?= $this->render('_'.$section->sectionTemplate->view, compact('invitation', 'messages', 'newMessage', 'section')); ?>

	<?php endif; ?>

<?php endforeach; ?>
