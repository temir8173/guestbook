<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Template $model
 */

$this->title = 'Create template';
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('common', 'Үлгілер'),
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
