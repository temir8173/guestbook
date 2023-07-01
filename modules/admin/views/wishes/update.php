<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Wish */

$this->title = 'Update wish: ' . $model->id;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('common', 'Тілектер'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="messages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
