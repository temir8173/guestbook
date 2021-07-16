<?php
namespace app\widgets\MultiLang;
use yii\helpers\Html;
use Yii;
?>

<div class="btn-group <?= $cssClass; ?>">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
        <span class="uppercase"><?= Yii::$app->language; ?></span>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li class="item-lang">
            <?= Html::a('Қазақша', array_merge(
                \Yii::$app->request->get(),
                ['/'.\Yii::$app->controller->route, 'language' => 'kk']
            )); ?>
        </li>
        <li class="item-lang">
            <?= Html::a('Русский', array_merge(
                \Yii::$app->request->get(),
                ['/'.\Yii::$app->controller->route, 'language' => 'ru']
            )); ?>
        </li>
    </ul>
</div>