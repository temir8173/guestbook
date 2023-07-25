<?php

use app\lists\GuestAnswersList;
use app\models\Invitation;
use app\models\Wish;
use app\models\WishSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var Invitation $invitation
 * @var WishSearch $searchModel
 * @var ActiveDataProvider $dataProvider
*/

$this->title = $invitation->name . ' - ' . Yii::t('common', 'Тілектер');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Менің шақыру билеттерім'), 'url' => ['/manage/invitations/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="messages-index">

            <h1><?= Html::encode($this->title) ?></h1>

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?php \yii\widgets\Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'options' => [
                    'class' => 'custom-grid'
                ],
                'columns' => [
                    [
                        'header' => '№',
                        'class' => 'yii\grid\SerialColumn',
                        'headerOptions' => ['style' => 'width: 3%'],
                    ],
                    [
                        'attribute' => 'name',
                        'headerOptions' => ['style' => 'width: 20%'],
                    ],
                    [
                        'attribute' => 'text',
                        'headerOptions' => ['style' => 'width: 47%'],
                    ],
                    [
                        'attribute' => 'answer',
                        'headerOptions' => ['style' => 'width: 10%'],
                        'filter' => GuestAnswersList::getAll(),
                        'value' => function(Wish $data){
                            return $data->answer ? GuestAnswersList::getShortTranslation($data->answer) : $data->answer;
                        },
                    ],
                    [
                        'attribute'=>'created_at',
                        'headerOptions' => ['style' => 'width: 15%'],
                        'format' => 'raw',
                        'filter' => false,
                        'value' => function(Wish $data){
                            return Yii::$app->formatter->asDate($data->created_at, 'php:Y.m.d H:i:s');
                        },
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{delete}',
                        'headerOptions' => ['style' => 'width: 7%'],
                    ],
                ],
            ]); ?>
            <?php \yii\widgets\Pjax::end(); ?>

        </div>

    </div>
</div>
