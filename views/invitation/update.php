<?php

use app\models\Invitation;
use app\models\Section;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Invitation $invitation
 * @var Section[] $sections
 */

$this->title = Yii::t('common', 'Шақыру билетін өзгерту');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Менің шақыру билеттерім'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invitations-create">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
        </div>
    </div>

    <?= $this->render('_form', [
        'invitation' => $invitation,
        'sections' => $sections,
    ]); ?>

</div>
