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
            'slug',
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 5%'],
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>


</div>
