<?php

use app\models\Invitation;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var app\models\WishSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var Invitation[] $invitationsByIds
 */

$this->title = Yii::t('common', 'Тілектер');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messages-index">
    <h1><?= Html::encode($this->title) ?></h1>

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
            'text',
            [
                'attribute'=>'invitation_id',
                'format' => 'raw',
                'filter' => ArrayHelper::map($invitationsByIds, 'id', 'name'),
                'value' => function($data) use ($invitationsByIds) {
                    $invitation = $invitationsByIds[$data->invitation_id];
                    $route = (int)$invitation->status === 0 ? '/invitation/preview' : '/invitation/view';

                    return Html::a(
                        $invitation->name,
                        [$route, 'url' => $invitation->url],
                        ['class' => 'profile-link', 'data-pjax' => '0', 'target' => '_blank']
                    );
                },
            ],
            [
                'attribute'=>'created_at',
                'format' => 'raw',
                'filter' => false,
                'value' => function($data){
                    return Yii::$app->formatter->asDate($data->created_at, 'php:Y.m.d H:i:s');
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
