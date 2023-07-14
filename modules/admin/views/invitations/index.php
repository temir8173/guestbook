<?php

use app\helpers\InvitationsHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\Invitation;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvitationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Шақыру билеттері';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invitations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(
            Yii::t('common', 'Жаңа шақыру билеті'),
            ['create' , 'template' => 'template1'],
            ['class' => 'btn btn-success create-invitation-btn']
        ) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'custom-grid'
        ],
        'columns' => [
            [
                'attribute'=>'id',
                'headerOptions' => ['style' => 'width: 3%'],
                'filter' => false,
            ],
            [
                'attribute'=>'name',
                'headerOptions' => ['style' => 'width: 20%'],
                'format' => 'raw',
                'value' => function($data) {
                    $route = '/invitation/view';

                    return Html::a(
                        $data->name,
                        [$route, 'url' => $data->url],
                        ['class' => 'profile-link', 'data-pjax' => '0', 'target' => '_blank']
                    );
                },
            ],
            [
                'attribute'=>'template_id',
                'headerOptions' => ['style' => 'width: 10%'],
                'format' => 'raw',
//                'filter' => ArrayHelper::map($invitationsByIds, 'id', 'name'),
                'value' => function($data) {
                    return $data->template->name;
                },
            ],
            'url',
            [
                'attribute'=>'is_demo',
                'headerOptions' => ['style' => 'width: 10%'],
                'format' => 'raw',
                'filter' => [0 => 'No', 1 => 'Yes'],
                'value' => function($data) {
                    return $data->is_demo ? 'Yes' : 'No';
                },
            ],
            [
                'attribute'=>'event_date',
                'headerOptions' => ['style' => 'width: 10%'],
                'format' => 'raw',
                'value' => function($data){
                    return Yii::$app->formatter->asDate($data->event_date);
                },
                'filter' => false,
            ],
            [
                'attribute'=>'created_at',
                'headerOptions' => ['style' => 'width: 10%'],
                'format' => 'raw',
                'value' => function($data){
                    return Yii::$app->formatter->asDate($data->created_at);
                },
                'filter' => false,
            ],
            [
                'attribute'=>'updated_at',
                'headerOptions' => ['style' => 'width: 10%'],
                'format' => 'raw',
                'value' => function($data){
                    return Yii::$app->formatter->asDate($data->updated_at);
                },
                'filter' => false,
            ],
            [
                'attribute'=>'status',
                'headerOptions' => ['style' => 'width: 10%'],
                'format' => 'raw',
                'value' => function (Invitation $model) {
                    return InvitationsHelper::statusLabel($model->status);
                },
                'filter' => Invitation::getStatusLabels(),
            ],

            // Customize the action column
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 5%'],
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span>',
                            ['/invitation/update', 'url' => $model->url],
                            ['target' => '_blank']
                        );
                    },
                ],
            ],
        ],
    ]); ?>


</div>
