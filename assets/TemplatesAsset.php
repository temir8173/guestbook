<?php

namespace app\assets;

use yii\web\AssetBundle;

class TemplatesAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/template1.css',
    ];
    public $js = [
        'js/jqueryForm.js',
        'js/simply-toast.min.js',
        'js/core.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
