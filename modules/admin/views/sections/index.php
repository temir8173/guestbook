<?php

use app\models\SectionSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View  $this
 * @var ActiveDataProvider $dataProvider
 * @var SectionSearch $searchModel
 */

$this->title = Yii::t('common', 'Секциялар');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section-examples-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Section', ['create'], ['class' => 'btn btn-success']) ?>
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
            'name',
            'name_rus',
            'slug',
            [
                'attribute' => 'is_optional',
                'header' => Yii::t('common', 'Міндетті емес(қосымша)'),
                'headerOptions' => ['style' => 'width: 15%'],
                'format' => 'raw',
                'filter' => false,
                'value' => function ($data){
                    return $data->is_optional
                        ? Yii::t('common', 'Иә')
                        : Yii::t('common', 'Жоқ');
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 5%'],
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>


</div>
