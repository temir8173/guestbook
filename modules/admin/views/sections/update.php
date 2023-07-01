<?php

use app\models\Section;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var Section $model
 */

$this->title = 'Update Section: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Секциялар'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="section-examples-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
