<?php

use app\models\FieldSearch;
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Section;

/**
 * @var yii\web\View $this
 * @var FieldSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Fields';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fields-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Fields', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
                'attribute'=>'section_id',
                'headerOptions' => ['style' => 'width: 25%'],
                'format' => 'raw',
                'value' => function($data){
                    return ($data->section_id !== null) ? Section::findOne($data->section_id)->name : $data->section_id; //Yii::$app->formatter->asDate($data->event_date);
                },
                'filter' => Section::find()->select(['name', 'id'])->indexBy('id')->column(),
            ],
            [
                'attribute' => 'slug',
                'filter' => false,
                'headerOptions' => ['style' => 'width: 20%'],
            ],
            [
                'attribute' => 'type',
                'filter' => false,
                'headerOptions' => ['style' => 'width: 20%'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 5%'],
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>


</div>
