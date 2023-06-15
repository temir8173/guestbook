<?php

use app\models\FieldValues;
use app\models\Invitation;
use app\models\Sections;
use app\models\Section;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Invitation $model
 * @var Section[] $sectionTemplates
 * @var Sections[] $sections
 * @var FieldValues[] $fieldValues
 */

$this->title = Yii::t('common', 'Жаңа шақыру билеті');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Менің шақыру билеттерім'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invitations-create">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>sdf<?= Html::encode($this->title) ?></h1>
            </div>
        </div>
    </div>

    <?= $this->render('_form', compact('model', 'sectionTemplates', 'sections', 'fieldValues')) ?>

</div>
