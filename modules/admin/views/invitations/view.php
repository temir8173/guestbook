<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Invitation */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Invitations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="invitations-view">

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
            [
                'attribute'=>'url',
                'format' => 'raw',
                'value' => function($data){
                    return "<a href=\"" . Url::base(true) . "/$data->url\" target=\"_blank\">" . Url::base(true) . "/$data->url</a>";
                },
            ],
            'name',
            [
                'attribute'=>'event_date',
                'format' => 'raw',
                'value' => function($data){
                    return Yii::$app->formatter->asDate($data->event_date);
                },
            ],
            [
                'attribute'=>'created_date',
                'format' => 'raw',
                'value' => function($data){
                    return Yii::$app->formatter->asDateTime($data->created_date);
                },
            ],
            [
                'attribute'=>'updated_date',
                'format' => 'raw',
                'value' => function($data){
                    return Yii::$app->formatter->asDateTime($data->updated_date);
                },
            ],
            [
                'attribute'=>'status',
                'format' => 'raw',
                'value' => function($data){
                    return ( $data->status == 1 ) ? 'Төленді' : 'Төленбеді';
                },
            ],
        ],
    ]) ?>

</div>
