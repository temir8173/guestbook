<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use app\widgets\multiLang\MultiLang;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AdminAsset;

AdminAsset::register($this);
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
</head>
<body>
<?php $this->beginBody() ?>

<?php
NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar navbar-expand-lg navbar-light',
    ],
]);
echo MultiLang::widget(['cssClass'=>'pull-right language']);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right ml-auto'],
    'items' => [
        ['label' => Yii::t('common', 'Барлық шақырулар'), 'url' => ['/admin/invitations']],
        ['label' => Yii::t('common', 'Тілектер'), 'url' => ['/admin/wishes']],
        ['label' => Yii::t('common', 'Үлгілер'), 'url' => ['/admin/templates']],
        ['label' => Yii::t('common', 'Секциялар'), 'url' => ['/admin/sections']],
        ['label' => Yii::t('common', 'Өрістер'), 'url' => ['/admin/fields']],
        ['label' => Yii::t('common', 'Аудио'), 'url' => ['/admin/audio']],
        Yii::$app->user->isGuest ? (
            ['label' => 'Кіру', 'url' => ['/auth/login']]
        ) : (
            '<li>'
            . Html::beginForm(['/auth/logout'], 'post')
            . Html::submitButton(
                'Шығу (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'
        )
    ],
]);
NavBar::end();
?>
<div class="wrap" style="padding-top: 50px;">

    <div class="container">
        <?php  ?>
        <?= Breadcrumbs::widget([
            'links' => $this->params['breadcrumbs'] ?? [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
