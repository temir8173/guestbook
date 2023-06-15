<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Invitation */

$this->title = 'Жаңа шақыру билеті';
$this->params['breadcrumbs'][] = ['label' => 'Шақыру билеттері', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invitations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model', 'sectionTemplates', 'sections', 'fieldValues')) ?>

</div>
