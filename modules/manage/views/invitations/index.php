<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvitationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Менің шақыру билеттерім');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invitations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('common', 'Жаңа шақыру билеті'), ['create'], ['class' => 'btn btn-info create-invitation-btn']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'custom-grid'
        ],
        'rowOptions'=>function($model){
            if($model->status === 0){
                return ['class' => 'danger'];
            } else {
                return ['class' => ''];
            }
        },
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style' => 'width: 3%'],
            ],

            [
                'attribute'=>'name',
                'headerOptions' => ['style' => 'width: 20%'],
            ],
            [
                'attribute'=>'url',
                'headerOptions' => ['style' => 'width: 25%'],
                'format' => 'raw',
                'value' => function($data){
                    if ($data->status === 0)
                        return Html::a(Url::base(true)."/preview/$data->url", ['/invitations/default/preview', 'view' => $data->url], ['class' => 'profile-link', 'data-pjax' => '0', 'target' => '_blank']);
                    else 
                         return Html::a(Url::base(true)."/$data->url", ['/invitations/default/index', 'view' => $data->url], ['class' => 'profile-link', 'data-pjax' => '0', 'target' => '_blank']);
                },
            ],
            [
                'attribute'=>'event_date',
                'headerOptions' => ['style' => 'width: 25%'],
                'format' => 'raw',
                'value' => function($data){
                    return Yii::$app->formatter->asDate($data->event_date);
                },
            ],
            [
                'attribute'=>'status',
                'headerOptions' => ['style' => 'width: 7%'],
                'format' => 'raw',
                'value' => function($data){
                    return ($data->status) ? Yii::t('common', 'Иә') : Yii::t('common', 'Жоқ');
                },
            ],
            [
                'attribute' => Yii::t('common', 'Тілектер'),
                'headerOptions' => ['style' => 'width: 7%'],
                'format' => 'raw',
                'value' => function($data){
                    return Html::a(Yii::t('common', 'Басқару'), ['/manage/messages/index', 'invitation_id' => $data->id], ['class' => 'profile-link', 'data-pjax' => '0']);
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete}',
                'headerOptions' => ['style' => 'width: 5%'],
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>


</div>
