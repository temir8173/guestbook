<?php

use app\helpers\InvitationsHelper;
use app\models\Invitation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvitationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Менің шақыру билеттерім');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">

        <div class="invitations-index">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a(Yii::t('common', 'Жаңа шақыру билеті'), ['create'], ['class' => 'btn btn-info create-invitation-btn']) ?>
            </p>
            <p id="text-to-copy">Copy this text to clipboard</p>

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
                        'header' => '№',
                        'class' => 'yii\grid\SerialColumn',
                        'headerOptions' => ['style' => 'width: 3%'],
                    ],

                    [
                        'attribute'=>'name',
                        'headerOptions' => ['style' => 'width: 15%'],
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
                    [
                        'attribute'=>'url',
                        'headerOptions' => ['style' => 'width: 25%'],
                        'format' => 'raw',
                        'value' => function($data) {
                            return Html::a(
                                Url::base(true) . "/$data->url",
                                ['/invitation/view', 'url' => $data->url],
                                ['class' => 'invitation-link', 'data-pjax' => '0', 'target' => '_blank']
                            ) . ' <button
                                 class="copy-button"
                                 data-message="' . Yii::t('common', 'Cілтеме көшірілді!') . '"
                             >'
                                . Yii::t('common', 'көшіру')
                                 . '</button>';
                        },
                    ],
                    [
                        'attribute'=>'event_date',
                        'headerOptions' => ['style' => 'width: 10%'],
                        'format' => 'raw',
                        'value' => function($data){
                            return Yii::$app->formatter->asDate($data->event_date);
                        },
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
                    [
                        'attribute' => Yii::t('common', 'Тілектер'),
                        'headerOptions' => ['style' => 'width: 7%'],
                        'format' => 'raw',
                        'value' => function($data){
                            return Html::a(Yii::t('common', 'басқару'), ['wishes', 'invitation_id' => $data->id], ['class' => 'wishes-link', 'data-pjax' => '0']);
                        },
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{update} {delete}',
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'update') {
                                return ['/invitation/update', 'url' => $model->url];
                            }

                            return \yii\helpers\Url::toRoute([$action, 'id' => $model->id]);
                        },
                        'headerOptions' => ['style' => 'width: 5%'],
                    ],
                ],
            ]); ?>
            <?php \yii\widgets\Pjax::end(); ?>


        </div>
    </div>
</div>
