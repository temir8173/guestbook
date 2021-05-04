<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvitationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Менің шақыру парақтарым';
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

            [
                'attribute'=>'id',
                'headerOptions' => ['style' => 'width: 3%'],
                'filter' => false,
            ],
            [
                'attribute'=>'url',
                'headerOptions' => ['style' => 'width: 30%'],
                'format' => 'raw',
                'value' => function($data){
                    if ($data->status === 0)
                        return "<a href=\"" . Url::base(true) . "/$data->url\" target=\"_blank\">" . Url::base(true) . "/$data->url</a>";
                    else 
                        return Html::a('asd', ['/invitations/default/index', 'view' => $data->url], ['class' => 'profile-link']);
                },
            ],
            [
                'attribute'=>'name',
                'headerOptions' => ['style' => 'width: 30%'],
            ],
            [
                'attribute'=>'event_date',
                'headerOptions' => ['style' => 'width: 30%'],
                'format' => 'raw',
                'value' => function($data){
                    return Yii::$app->formatter->asDate($data->event_date);
                },
            ],
            [
                'attribute' => 'Тілектер',
                'headerOptions' => ['style' => 'width: 7%'],
                'format' => 'raw',
                'value' => function($data){
                    return Html::a('Басқару', ['/manage/messages/index', 'invitation_id' => $data->id], ['class' => 'profile-link']);
                },
            ]
            /*[
                'attribute'=>'created_date',
                'format' => 'raw',
                'value' => function($data){
                    return Yii::$app->formatter->asDate($data->created_date);
                },
            ],*/
            /*[
                'attribute'=>'fields',
                'filter' => false,
                'format' => 'raw',
                'value' => function($data){
                    return "<a href=".Url::to(['/admin/field-values/index', 'invitation_id' => 1]).">fields</a>";
                },
            ],*/
            //'updated_date',
            //'status',

            /*['class' => 'yii\grid\ActionColumn'],*/
        ],
    ]); ?>


</div>
