<?php

use app\lists\TemplateTypesList;
use app\models\AudioSearch;
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var app\models\AudioSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('common', 'Әуендер');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messages-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Audio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'id',
                'headerOptions' => ['style' => 'width: 3%'],
                'filter' => false,
            ],
            [
                'attribute' => 'name',
                'headerOptions' => ['style' => 'width: 10%'],
                'filter' => false,
            ],
            [
                'attribute' => 'type',
                'format' => 'raw',
                'headerOptions' => ['style' => 'width: 10%'],
                'filter' => TemplateTypesList::getAll(),
                'value' => function ($data) {
                    return TemplateTypesList::getName($data->type);
                },
            ],
            [
                'attribute' => 'path',
                'format' => 'raw',
                'filter' => false,
                'value' => function (AudioSearch $data){
                    return "<audio controls><source src=\"{$data->audio}\"  type=\"audio/mp3\"></audio> ";
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 7%'],
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>


</div>
