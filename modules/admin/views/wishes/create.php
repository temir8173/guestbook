<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Wish $model
 */

$this->title = 'Create wish';
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('common', 'Тілектер'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
