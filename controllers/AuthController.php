<?php


namespace app\controllers;


use app\forms\LoginForm;
use app\models\ResetPasswordForm;
use app\models\User;
use Exception;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class AuthController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @return Response|string
     * @throws NotFoundHttpException
     */
    public function actionLogin()
    {
        if (1 || Yii::$app->request->isAjax && Yii::$app->user->isGuest) {
            $form = new LoginForm();
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                $user = $form->getUser();
                if($user->status === User::STATUS_ACTIVE){
                    Yii::$app->user->login($user, $form->rememberMe ? 3600 * 24 * 30 : 0);
                    Yii::$app->session->setFlash('success', 'You have been logged in!');
                }
                if($user->status === User::STATUS_WAIT){
                    Yii::$app->session->setFlash('warning', 'To complete the registration, confirm your email. Check your email.');
                }
                return $this->goBack();
            }

            $form->password = '';
            $this->layout = 'front-page';
            return $this->render('login', [
                'model' => $form,
            ]);
        }

        throw new NotFoundHttpException();
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

        $this->layout = 'front-page';
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
        } catch (Exception $e){
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
                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Өкінішке орай, енгізілген аккаунттың құпия сөзін қалпына келтіре алмаймыз.');
        }

        $this->layout = 'front-page';
        return $this->render('requestPasswordReset', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param $t
     * @return Response|string
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($t)
    {
        try {
            $model = new ResetPasswordForm($t);
        } catch (Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->goBack();
        }

        $this->layout = 'front-page';
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