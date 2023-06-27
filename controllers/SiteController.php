<?php

namespace app\controllers;

use Yii;
use yii\captcha\CaptchaAction;

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
        //"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
        //preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', '21184@Ss', $matches);
        if ( !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', '21184@Ss') ) {
            //$this->addError($attribute, 'Құпия сөз кем дегенде 8 таңбадан, 1 бас әріптен, 1 кіші әріптен, 1 цифрадан және 1 арнайы таңбадан тұруы керек');
            var_dump('sdafsdfsdf');die;
        }
        
        $this->layout = 'front-page';

        return $this->render('index');
    }

    public function actionTemplates(): string
    {
        return $this->render('templates');
    }
}
