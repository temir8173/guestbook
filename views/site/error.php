<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>4<span>0</span>4</h1>
        </div>
        <p><?= Yii::t('common', 'Бет табылмады. Сіз сұраған парақша жоқ') ?></p>
        <a href="/"><?= Yii::t('common', 'Басты бет') ?></a>
    </div>
</div>
