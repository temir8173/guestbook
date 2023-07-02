<?php

namespace app\widgets\multiLang;

use yii\bootstrap\Widget;

class MultiLang extends Widget
{
    public string $cssClass;
    public function init(){}

    public function run() {

        return $this->render('view', [
            'cssClass' => $this->cssClass,
        ]);

    }
}