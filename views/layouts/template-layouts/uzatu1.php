<?php

/* @var $this View */
/* @var $content string */

use app\assets\templates\Uzatu1Asset;
use yii\helpers\Html;
use yii\web\View;

Uzatu1Asset::register($this);
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
