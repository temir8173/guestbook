<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\Messages;
use app\models\User;
use yii\helpers\Json;
use app\models\ImagesUploadForm;
use yii\web\UploadedFile;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $this->layout = 'front-page';

        return $this->render('index');


        /*$newMessage = new Messages();
        $messages = Messages::find()->orderBy(['date' => SORT_DESC])->all();

        if (Yii::$app->request->isAjax) {

            $return = array(
                'error' => 1,
                'message' => 'Ошибка. Неверный формат данных!',
            );
            //var_dump(Yii::$app->request->post());die;
            if ($newMessage->load(Yii::$app->request->post()) && $newMessage->save()) {
                $return = array(
                    'error' => 0,
                    'message' => 'Ваше сообщение было успешно добавлено!',
                );
            }
            return Json::encode($return);

        } else {
            return $this->render('index', compact('messages', 'newMessage'));
        }*/
        
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
        $form = new SignupForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            //$signupService = new SignupService();

            try{
                $form->signup();
                Yii::$app->session->setFlash('success', 'Check your email to confirm the registration.');
                //$form->sentEmailConfirm($user);
                return $this->goHome();
            } catch (\RuntimeException $e){
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('signup', [
            'model' => $form,
        ]);
    }

    public function actionSignupConfirm($t)
    {
        $form = new SignupForm();

        try{
            $form->confirmation($t);
            Yii::$app->session->setFlash('success', 'You have successfully confirmed your registration.');
        } catch (\Exception $e){
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->goHome();
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
 
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Келесі нұсқаулар алу үшін электрондық поштаны тексеріңіз.');
                //return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Өкінішке орай, енгізілген аккаунттың құпия сөзін қалпына келтіре алмаймыз.');
            }
        }
 
        return $this->render('requestPasswordReset', [
            'model' => $model,
        ]);
    }
 
    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($t)
    {
        try {
            $model = new ResetPasswordForm($t);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
 
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }
 
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
