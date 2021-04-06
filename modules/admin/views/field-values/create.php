<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FieldValues */

$this->title = 'Create Field Values';
$this->params['breadcrumbs'][] = ['label' => 'Field Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="field-values-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'invitation_id' => $invitation_id,
    ]) ?>

</div>
