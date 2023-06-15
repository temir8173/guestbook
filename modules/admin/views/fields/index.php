<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Section;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FieldSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fields';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fields-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Fields', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width: 3%'],
                'filter' => false,
            ],
            [
                'attribute' => 'name',
                'headerOptions' => ['style' => 'width: 25%'],
            ],
            [
                'attribute'=>'section_template_id',
                'headerOptions' => ['style' => 'width: 25%'],
                'format' => 'raw',
                'value' => function($data){
                    return ($data->section_template_id !== null) ? Section::findOne($data->section_template_id)->name : $data->section_template_id; //Yii::$app->formatter->asDate($data->event_date);
                },
                'filter' => Section::find()->select(['name', 'id'])->indexBy('id')->column(),
            ],
            [
                'attribute' => 'url',
                'headerOptions' => ['style' => 'width: 20%'],
            ],
            [
                'attribute' => 'type',
                'headerOptions' => ['style' => 'width: 20%'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия', 
                'headerOptions' => ['style' => 'width: 7%'],
            ],
        ],
    ]); ?>


</div>
