<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SectionExamples */

$this->title = 'Create Section Examples';
$this->params['breadcrumbs'][] = ['label' => 'Section Examples', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section-examples-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
