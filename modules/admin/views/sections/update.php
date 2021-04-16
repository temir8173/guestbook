<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SectionExamples */

$this->title = 'Update Section Examples: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Section Examples', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="section-examples-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
