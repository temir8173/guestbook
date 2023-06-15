<?php

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$isDev = $_ENV['ENV'] === "dev";

define("YII_ENV", $_ENV['ENV']);
define("YII_DEBUG", $isDev);

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
