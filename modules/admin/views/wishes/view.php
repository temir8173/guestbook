<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Wish */

$this->title = $model->id;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('common', 'Тілектер'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="messages-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'text',
            [
                'attribute'=>'created_at',
                'format' => 'raw',
                'value' => function($data){
                    return Yii::$app->formatter->asDate($data->created_at, 'php:Y.m.d H:i:s');;
                },
            ],
        ],
    ]) ?>

</div>
