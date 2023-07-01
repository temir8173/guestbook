<?php

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
        <?= Html::a('Жаңа', ['create'], ['class' => 'btn btn-success create-invitation-btn']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
//                'filter' => ArrayHelper::map($invitationsByIds, 'id', 'name'),
                'value' => function($data) {
                    $route = (int)$data->status === 0 ? '/invitation/preview' : '/invitation/view';

                    return Html::a(
                        $data->name,
                        [$route, 'url' => $data->url],
                        ['class' => 'profile-link', 'data-pjax' => '0', 'target' => '_blank']
                    );
                },
            ],
            'template_id',
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
                'attribute'=>'created_date',
                'headerOptions' => ['style' => 'width: 10%'],
                'format' => 'raw',
                'value' => function($data){
                    return Yii::$app->formatter->asDate($data->created_at);
                },
                'filter' => false,
            ],
            /*[
                'attribute'=>'fields',
                'filter' => false,
                'format' => 'raw',
                'value' => function($data){
                    return "<a href=".Url::to(['/admin/field-values/index', 'invitation_id' => 1]).">fields</a>";
                },
            ],*/
            //'updated_date',
            [
                'attribute'=>'updated_date',
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
                'value' => function (\app\models\Invitation $model) {
                    return \app\helpers\InvitationsHelper::statusLabel($model->status);
                },
                'filter' => Invitation::getStatusLabels(),
            ],
            //'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete}',
                'headerOptions' => ['style' => 'width: 5%'],
            ],
        ],
    ]); ?>


</div>
