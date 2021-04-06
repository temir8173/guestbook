<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Invitations */

$this->title = 'Create Invitations';
$this->params['breadcrumbs'][] = ['label' => 'Invitations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invitations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
