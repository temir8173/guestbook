<?php

namespace app\assets\templates;

use yii\web\AssetBundle;

class Template3Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/templates/template3.css',
        'css/animations.css',
    ];
    public $js = [
        'js/animations.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
