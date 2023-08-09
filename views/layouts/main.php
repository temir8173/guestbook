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
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" type="image/png" href="/images/favicon1.png"/>
    <?php $this->head() ?>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
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

<?= $this->render('modals/_login'); ?>
<?= $this->render('modals/_signup'); ?>
<?= $this->render('modals/_recover'); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
