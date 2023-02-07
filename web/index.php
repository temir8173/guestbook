<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';
//var_dump('ttt');die;
function my_dump($var) {
	echo '<pre>'; var_dump($var); echo '</pre>';
}

(new yii\web\Application($config))->run();
