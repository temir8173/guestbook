<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Messages */

$this->title = 'Тілекті өзгерту: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Менің шақыру парақтарым', 'url' => ['/manage/invitations/index']];
$this->params['breadcrumbs'][] = ['label' => $model->invitation->name . ' - Тілектер', 'url' => ['index', 'invitation_id' => $model->invitation->id]];
$this->params['breadcrumbs'][] = 'Өзгерту';
?>
<div class="messages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
