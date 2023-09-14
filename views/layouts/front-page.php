<?php

/* @var $this View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\FrontPageAsset;
use yii\web\View;

FrontPageAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" type="image/png" href="/images/favicon1.png"/>
    <meta name="description" content="Заманауи нақыштағы сайт шақыру үлгілері.  Қыз ұзату, үйлену той, сүндет той және
     басқа да барлық тойларға арналған шақырулар конструкторы. Ерекше әрі жаңа дизайндар.">
    <meta name="keywords" content="shaqyru, шақыру, онлайн шақыру, онлайн пригласительный, сайт шақыру,
     сайт пригласительный, қыз ұзату, шақыру текст, сүндет той, кыз узату, сундет той, уйлену той, үйлену
     той, бесік той, бесик той, мерей той, юбилей, пригласительные, тойға шақыру, тойга шакыру">
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?= $this->render('@app/views/layouts/main/_header.php') ?>

    <?= $content ?>
</div>

<?= $this->render('main/_footer.php') ?>

<?= $this->render('modals/_login'); ?>
<?= $this->render('modals/_signup'); ?>
<?= $this->render('modals/_recover'); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
