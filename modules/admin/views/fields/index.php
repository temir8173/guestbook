<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FieldsSearch */
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

            'id',
            'name',
            'section_example_id',
            'type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
