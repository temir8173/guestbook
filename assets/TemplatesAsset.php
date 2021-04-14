<?php

namespace app\assets;

use yii\web\AssetBundle;

class TemplatesAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/template1.css',
        'js/baguettebox/baguetteBox.min.css',
    ];
    public $js = [
        'js/countdown.js',
        'js/baguettebox/baguetteBox.min.js',
        'js/jqueryForm.js',
        'js/simply-toast.min.js',
        'js/core.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
