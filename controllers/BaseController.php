<?php

namespace app\controllers;

use app\forms\LoginForm;
use app\forms\SignupForm;
use app\forms\RecoverRequestForm;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class BaseController extends Controller
{
    /**
     * @throws BadRequestHttpException
     */
    public function beforeAction($action): bool
    {
        $loginForm = new LoginForm();
        $signupForm = new SignupForm();
        $recoverRequestForm = new RecoverRequestForm();

        $this->view->params['loginForm'] = $loginForm;
        $this->view->params['signupForm'] = $signupForm;
        $this->view->params['recoverRequestForm'] = $recoverRequestForm;

//        var_dump(Yii::$app->request->getUserAgent());
//        var_dump(Yii::$app->request->getUserIP());

        return parent::beforeAction($action);
    }
}