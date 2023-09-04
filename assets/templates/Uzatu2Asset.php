<?php

namespace app\assets\templates;

use yii\web\AssetBundle;

class Uzatu2Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/templates/uzatu2.css',
    ];
    public $js = [
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
