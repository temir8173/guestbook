<?php

namespace app\components;

use yii\base\BootstrapInterface;

class DisableLanguageMiddleware implements BootstrapInterface
{
    public function bootstrap($app)
    {
        // Disable browser language detection
        $app->language = $app->sourceLanguage;
    }
}