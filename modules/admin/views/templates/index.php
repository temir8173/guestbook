<?php

use app\lists\TemplateTypesList;
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var app\models\WishSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('common', 'Үлгілер');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messages-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Template', ['create'], ['class' => 'btn btn-success']) ?>
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
            'slug',
            'name',
            [
                'attribute' => 'type',
                'format' => 'raw',
                'filter' => TemplateTypesList::getAll(),
                'value' => function ($data) {
                    return TemplateTypesList::getName($data->type);
                },
            ],
            [
                'attribute' => 'price',
                'format' => 'raw',
                'filter' => false,
            ],
            [
                'attribute' => 'discount_price',
                'format' => 'raw',
                'filter' => false,
            ],
            [
                'attribute' => 'preview_img',
                'format' => 'raw',
                'filter' => false,
                'value' => function ($data){
                    return "<img width='150' src=\"/uploads/template_previews/{$data->preview_img}\">";
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
