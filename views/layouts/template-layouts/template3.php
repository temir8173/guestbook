<?php

use app\assets\templates\Template3Asset;
use app\lists\TemplateTypesList;
use app\models\Invitation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 * @var string $content
 * @var Invitation $invitation
 */

Template3Asset::register($this);
$invitation = $this->context->view->params['invitation'] ?? null;
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
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" type="image/png" href="/images/favicon1.png"/>

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?= Url::current([], true) ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= $invitation?->name ?> - <?= TemplateTypesList::getName($invitation?->template?->type) ?? '' ?>">
    <meta property="og:description" content="<?= Yii::t('common', 'Шақыру парақшасы') ?>">
    <meta property="og:image" content="<?= Url::base(true) ?>/images/logo.jpg">
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="300" />

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="shaqiru.kz">
    <meta property="twitter:url" content="<?= Url::current([], true) ?>">
    <meta name="twitter:title" content="<?= $invitation?->name ?> - <?= TemplateTypesList::getName($invitation?->template?->type) ?? '' ?>">
    <meta name="twitter:description" content="<?= Yii::t('common', 'Шақыру парақшасы') ?>">
    <meta name="twitter:image" content="<?= Url::base(true) ?>/images/logo.jpg">
    <?php $this->head() ?>
    <?php
        $variables = array (
            'language' => Yii::$app->language,
            // Тут обычно какие-то другие переменные
        );
        echo '<script type="text/javascript">window.my_data = ' . json_encode($variables) . ';</script>';
    ?>
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


<?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
