<?php

namespace app\controllers;

use app\models\Template;
use Yii;
use yii\captcha\CaptchaAction;
use yii\helpers\ArrayHelper;
use yii\web\Response;

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

    public function actionIndex(): Response|string
    {
        if (!Yii::$app->session->get('userVisitedBefore')) {
            Yii::$app->session->set('userVisitedBefore', true);
            return $this->redirect(['/'. Yii::$app->controller->route, 'language' => 'kk']);
        }
        $this->layout = 'front-page';

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

    public function actionOnlinePayment(): string
    {
        $locale = Yii::$app->formatter->locale;

        return $this->render('payment');
//        return ($locale === 'ru') ? $this->render('payment_ru') : $this->render('payment');
    }

    public function actionWarranty(): string
    {
        $locale = Yii::$app->formatter->locale;

        return $this->render('warranty');
//        return ($locale === 'ru') ? $this->render('payment_ru') : $this->render('payment');
    }

    public function actionContractOffer(): string
    {
        $locale = Yii::$app->formatter->locale;

        return $this->render('contract_offer');
//        return ($locale === 'ru') ? $this->render('payment_ru') : $this->render('payment');
    }
}
