<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvitationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invitations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invitations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Invitations', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'url',
                'format' => 'raw',
                'value' => function($data){
                    return "<a href=\"" . Url::base(true) . "/$data->url\" target=\"_blank\">" . Url::base(true) . "/$data->url</a>";
                },
            ],
            'name',
            [
                'attribute'=>'event_date',
                'format' => 'raw',
                'value' => function($data){
                    return Yii::$app->formatter->asDate($data->event_date);
                },
            ],
            [
                'attribute'=>'created_date',
                'format' => 'raw',
                'value' => function($data){
                    return Yii::$app->formatter->asDate($data->created_date);
                },
            ],
            [
                'attribute'=>'fields',
                'filter' => false,
                'format' => 'raw',
                'value' => function($data){
                    return "<a href=".Url::to(['/admin/field-values/index', 'invitation_id' => 1]).">fields</a>";
                },
            ],
            //'updated_date',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
