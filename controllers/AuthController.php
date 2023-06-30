<?php


namespace app\controllers;


use app\forms\LoginForm;
use app\forms\RecoverRequestForm;
use app\forms\SignupForm;
use app\forms\ResetPasswordForm;
use app\models\User;
use app\models\UserIdentity;
use app\services\auth\RecoverService;
use app\services\auth\SignupService;
use Exception;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class AuthController extends Controller
{
    public function __construct(
        $id,
        $module,
        private SignupService $signupService,
        private RecoverService $recoverService,

        $config = []
    ) {

        parent::__construct($id, $module, $config);
    }

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
        ];
    }

    public function actionLogin(): string
    {
        $form = new LoginForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $user = $form->getUser();
            if($user->status === User::STATUS_ACTIVE){
                Yii::$app->user->login($user, $form->rememberMe ? 3600 * 24 * 30 : 0);
                Yii::$app->session->setFlash(
                    'success',
                    Yii::t('common', 'Сәлеметсіз бе ')
                    . $user->username . '!'
                );
            }
            if($user->status === User::STATUS_WAIT){
                Yii::$app->session->setFlash(
                    'warning',
                    Yii::t('common', 'Email-ңызды растаңыз')
                );
            }
        }

        $form->password = '';
        $this->layout = 'front-page';

        return $this->render('login', [
            'model' => $form,
        ]);
    }

    /**
     * For ajax
    */
    public function actionDoLogin()
    {
        $response = [
            'success' => false,
            'message' => null,
        ];

        $form = new LoginForm();
        if ($form->load(Yii::$app->request->post())) {
            if ($form->validate()) {
                $user = $form->getUser();
                if ($user->status === User::STATUS_ACTIVE){
                    Yii::$app->user->login($user, $form->rememberMe ? 3600 * 24 * 30 : 0);
                    $response['success'] = true;
                    $response['message'] = Yii::t('common', 'Сәлеметсіз бе ')
                        . $user->username . '!';
                }
                if ($user->status === User::STATUS_WAIT){
                    $response['message'] = Yii::t('common', 'Email-ңызды растаңыз');
                }
            } else {
                $response['message'] = $form->getErrorSummary(false)[0];
            }
        }

        echo Json::encode($response);
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup(): Response|string
    {
        $response = [
            'success' => false,
            'message' => null,
        ];

        $form = new SignupForm();
        if ($form->load(Yii::$app->request->post())) {
            if ($form->validate()) {
                try {
                    $this->signupService->process($form->getData());
                    $response['success'] = true;
                    $response['message'] = Yii::t(
                        'common',
                        'Поштаңызға сілтеме жіберілді, поштаңызды растаңыз'
                    );
                } catch (Exception $e){
                    $response['message'] = $e->getMessage();
                }
            } else {
                $response['message'] = $form->getErrorSummary(false)[0];
            }
        }

        if (Yii::$app->request->isAjax) {
            echo Json::encode($response);
            exit();
        }

        Yii::$app->session->setFlash(
            $response['success'] ? 'success' : 'error',
            $response['message']
        );
        if ($response['success']) {
            return $this->goHome();
        }

        $this->layout = 'front-page';
        return $this->render('signup', [
            'model' => $form,
        ]);
    }

    public function actionSignupConfirm($t): Response
    {
        try{
            $this->signupService->confirm($t);
            Yii::$app->session->setFlash(
                'success',
                Yii::t('common', 'Email сәтті расталды')
            );
        } catch (Exception $e){
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->goHome();
    }

    /**
     * @throws \yii\base\Exception
     */
    public function actionRecoverRequest(): Response|string
    {
        $response = [
            'success' => false,
            'message' =>
                Yii::t('common', 'Өкінішке орай аккаунтты қалпына келтіре алмаймыз.'),
        ];

        $form = new RecoverRequestForm();
        if ($form->load(Yii::$app->request->post())) {
            if ($form->validate()) {
                $this->recoverService->sendEmail($form->getUser());
                $response['success'] = true;
                $response['message'] = Yii::t('common', 'Келесі нұсқаулар алу үшін электрондық поштаны тексеріңіз.');
            } else {
                $response['message'] = $form->getErrorSummary(false)[0];
            }
        }

        if (Yii::$app->request->isAjax) {
            echo Json::encode($response);
            exit();
        }

        Yii::$app->session->setFlash(
            $response['success'] ? 'success' : 'error',
            $response['message']
        );
        if ($response['success']) {
            return $this->goHome();
        }

        $this->layout = 'front-page';
        return $this->render('recoverRequest', [
            'model' => $form,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionResetPassword($t): Response|string
    {
        $user = UserIdentity::findByPasswordResetToken($t);
        if (!$user) {
            throw new NotFoundHttpException();
        }

        $form = new ResetPasswordForm($user);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            Yii::$app->user->login($user);
            $this->recoverService->resetPassword($user, $form->password);
            Yii::$app->session->setFlash(
                'success',
                Yii::t('common', 'Құпия сөз өзгертілді'),
            );
            return $this->goHome();
        }

        $this->layout = 'front-page';
        return $this->render('resetPassword', [
            'model' => $form,
        ]);
    }
}
