<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\SectionTemplates;

/* @var $this yii\web\View */
/* @var $model app\models\Fields */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Fields', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fields-view">

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
            'name',
            [
                'attribute'=>'section_template_id',
                'format' => 'raw',
                'value' => function($data){
                    return ($data->section_template_id !== null) ? SectionTemplates::findOne($data->section_template_id)->name : $data->section_template_id; //Yii::$app->formatter->asDate($data->event_date);
                },
            ],
            'type',
        ],
    ]) ?>

</div>
