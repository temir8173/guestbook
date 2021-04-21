<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Messages';
$this->params['breadcrumbs'][] = ['label' => 'Шақыру парақшасы', 'url' => ['/manage/invitations/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messages-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style' => 'width: 5%'],
            ],

            [
                'attribute'=>'id',
                'headerOptions' => ['style' => 'width: 5%'],
            ],
            [
                'attribute'=>'name',
                'headerOptions' => ['style' => 'width: 20%'],
            ],
            [
                'attribute'=>'text',
                'headerOptions' => ['style' => 'width: 47%'],
            ],
            [
                'attribute'=>'date',
                'headerOptions' => ['style' => 'width: 15%'],
                'format' => 'raw',
                'value' => function($data){
                    return Yii::$app->formatter->asDate($data->date, 'php:Y.m.d H:i:s');
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 7%'],
            ],
        ],
    ]); ?>


</div>
