<?php

namespace app\controllers;

use app\models\Template;
use Yii;
use yii\captcha\CaptchaAction;
use yii\helpers\ArrayHelper;

class SiteController extends BaseController
{
    public function actions()
    {
        return [
            'captcha' => [
                'class' => CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionError(): bool|string
    {
        $this->layout = 'empty';
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }

        return $this->render('error');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        /** @var Template[] $templates */
        $templates = Template::find()
            ->select(['name', 'price', 'slug', 'type', 'preview_img', 'discount_price'])
            ->all();

        $groupedTemplates = [];
        foreach ($templates as $template) {
            $groupedTemplates[$template->type][] = $template;
        }

        return $this->render('index', ['templates' => $groupedTemplates]);
    }

    public function actionTemplates(): string
    {
        /** @var Template[] $templates */
        $templates = Template::find()
            ->select(['name', 'price', 'slug', 'type', 'preview_img', 'discount_price'])
            ->all();

        $groupedTemplates = [];
        foreach ($templates as $template) {
            $groupedTemplates[$template->type][] = $template;
        }

        return $this->render('templates', ['templates' => $groupedTemplates]);
    }

    public function actionRules(): string
    {
        $locale = Yii::$app->formatter->locale;

        return ($locale === 'ru') ? $this->render('rules_ru') : $this->render('rules');
    }

    public function actionPrivacyPolicy(): string
    {
        $locale = Yii::$app->formatter->locale;

        return ($locale === 'ru') ? $this->render('privacy_ru') : $this->render('privacy');
    }
}
