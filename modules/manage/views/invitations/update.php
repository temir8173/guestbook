<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Invitation */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Менің шақыру билеттерім'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
$this->params['breadcrumbs'][] = Yii::t('common', 'Өңдеу');
?>
<div class="invitations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model', 'sectionTemplates', 'sections', 'fieldValues')) ?>

</div>
