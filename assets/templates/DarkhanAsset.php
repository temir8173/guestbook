<?php

namespace app\assets\templates;

use yii\web\AssetBundle;

class DarkhanAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/templates/darkhan.css',
        'css/animations.css',
    ];
    public $js = [
        'js/animations.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
