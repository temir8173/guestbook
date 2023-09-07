<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/site.css',
        'css/fonts.css',
        'js/baguettebox/baguetteBox.min.css',
    ];
    public $js = [
        'js/countdown.js',
        'js/baguettebox/baguetteBox.min.js',
        'js/jqueryForm.js',
        'js/simply-toast.min.js',
        'js/bootstrap.min.js',
        'js/core.js',
        "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js",
        "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        /*'yii\bootstrap\BootstrapAsset',*/
    ];
}
