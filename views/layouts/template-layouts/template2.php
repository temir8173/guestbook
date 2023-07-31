<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\NabatAsset;
use app\widgets\MultiLang\MultiLang;

NabatAsset::register($this);
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
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
    
    <link rel="stylesheet" href="assets/css/style.css">

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
