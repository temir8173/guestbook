<?php

use app\models\Section;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var Section $model
 */

$this->title = 'Create Section';
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Секциялар'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section-examples-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
