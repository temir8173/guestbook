<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Audio $model
 */

$this->title = 'Create audio';
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('common', 'Әуендер'),
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
