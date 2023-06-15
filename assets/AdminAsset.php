<?php

namespace app\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/admin.css',
    ];
    public $js = [
        'js/admin.js',
        'https://maps.api.2gis.ru/2.0/loader.js?pkg=full',
    ];
    public $depends = [
        'app\assets\AppAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
