<?php

use app\lists\TemplateTypesList;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Template */

$this->title = $model->id;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('common', 'Үлгілер'),
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
            'slug',
            'name',
            [
                'attribute'=>'preview_img',
                'format' => 'raw',
                'value' => function ($data){
                    return "<img width='250' src=\"/uploads/template_previews/{$data->preview_img}\">";
                },
            ],
            [
                'attribute' => 'type',
                'format' => 'raw',
                'value' => function ($data) {
                    return TemplateTypesList::getName($data->type);
                },
            ],
            'price',
            'discount_price',
            [
                'attribute' => 'sections',
                'format' => 'raw',
                'value' => function ($data) {
                    return Json::encode($data->sections);
                },
            ],
        ],
    ]) ?>

</div>
