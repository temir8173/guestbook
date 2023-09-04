<?php

use app\assets\templates\Uzatu2Asset;
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

Uzatu2Asset::register($this);
$invitation = $this->context->view->params['invitation'] ?? null;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" type="image/png" href="/images/favicon1.png"/>

    <meta property="og:url" content="<?= Url::base(true) ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= $invitation?->name ?> - <?=
    TemplateTypesList::getName($invitation?->template?->type) ?? '' ?>">
    <meta property="og:description" content="<?= Yii::t('common', 'Шақыру парақшасы') ?>">
    <meta property="og:image" content="<?= Url::base(true) ?>/images/favicon1.png">
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="300" />
    <?php $this->head() ?>
    <?php 
        $variables = array (
            'language' => Yii::$app->language,
            // Тут обычно какие-то другие переменные
        );
        echo '<script type="text/javascript">window.my_data = ' . json_encode($variables) . ';</script>';
    ?>
</head>
<body>
<?php $this->beginBody() ?>

   
<?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
