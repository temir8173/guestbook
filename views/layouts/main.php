<?php

/* @var $this View */
/* @var $content string */

use app\assets\AdminAsset;
use app\assets\FrontPageAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Breadcrumbs;

AdminAsset::register($this);
FrontPageAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-X236ZF38GG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-X236ZF38GG');
    </script>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '272195845765142');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=272195845765142&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Meta Pixel Code -->
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?= $this->render('@app/views/layouts/main/_header.php') ?>

    <?php if (0 && isset($this->params['breadcrumbs'])) : ?>
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => $this->params['breadcrumbs'] ?? [],
            ]) ?>
            <?= Alert::widget() ?>
            
        </div>
    <?php endif; ?>
    <?= $content ?>
</div>

<?= $this->render('main/_footer.php') ?>
<?= $this->render('modals/_auth_modal'); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
