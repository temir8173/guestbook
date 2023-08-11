<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<?php if ($exception?->statusCode === 404) { ?>
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>4<span>0</span>4</h1>
            </div>
            <p><?= Yii::t('common', 'Бет табылмады. Сіз сұраған парақша жоқ') ?></p>
            <a href="/"><?= Yii::t('common', 'Басты бет') ?></a>
        </div>
    </div>
<?php } else { ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="site-error">
                    <h1><?= Html::encode($this->title) ?></h1>

                    <div class="alert alert-danger">
                        <?= nl2br(Html::encode($exception->getMessage())) ?>
                    </div>

                    <p>
                        The above error occurred while the Web server was processing your request.
                    </p>
                    <p>
                        Please contact us if you think this is a server error. Thank you.
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
