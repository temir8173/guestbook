<?php


namespace app\controllers;


use app\forms\LoginForm;
use app\forms\OauthCallbackForm;
use app\forms\RecoverRequestForm;
use app\forms\SignupForm;
use app\forms\ResetPasswordForm;
use app\models\User;
use app\models\UserIdentity;
use app\services\auth\RecoverService;
use app\services\auth\SignupService;
use app\services\OauthGoogleService;
use app\services\SmsService;
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
        private OauthGoogleService $oauthGoogleService,
        private SmsService $smsService,

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

    /**
     * @throws NotFoundHttpException
     */
    public function actionLogin(): string
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException();
        }

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

        $form->passwordOrCode = '';
        $this->layout = 'front-page';

        return $this->renderAjax('login', [
            'model' => $form,
        ]);
    }

    /**
     * @throws \yii\httpclient\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function actionSendCode()
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException();
        }

        $response = [
            'success' => false,
            'code' => null,
            'message' => Yii::t('common', 'Нөмір тіркелмеген')
        ];

        $phoneNumber = Yii::$app->request->getBodyParam('phone');

        if (!$phoneNumber) {
            $response['message'] = Yii::t('common', 'Нөмір енгізіңіз');
            echo Json::encode($response);
            exit();
        }

        $user = UserIdentity::findByPhoneOrEmail($phoneNumber);

        if ($user && $user->phone_number) {
            $code = sprintf("%04d", rand(0, 9999));
            $user->sms_code = $code;
            $user->save(false);

            $sms = Yii::t('common', 'Kelesi kod arqyly kiriniz - ') . $code . '. ShaqiruKZ';
            $isCodeSent = $this->smsService->send($user->phone_number, $sms);
            if ($isCodeSent) {
                $response['success'] = true;
                $response['code'] = $code;
                $response['message'] = Yii::t('common', 'Жіберілген смс арқылы кіріңіз');
            } else {
                $response['message'] = Yii::t('common', 'Смс жіберілмеді');
            }
        }

        echo Json::encode($response);
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

    /**
     * @throws NotFoundHttpException
     */
    public function actionSignup(): Response|string
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException();
        }

        $form = new SignupForm();
        if ($form->load(Yii::$app->request->post()) && !Yii::$app->request->getBodyParam('only_render')) {
            $response = [
                'success' => false,
                'message' => null,
            ];
            try {
                if ($form->validate()) {
                    $user = $this->signupService->process($form->getData(), false);
                    Yii::$app->user->login($user);
                    $response['success'] = true;
                    $response['message'] = Yii::t('common', 'Сіз сәтті тіркелдіңіз');
                } else {
                    $response['message'] = $form->getErrorSummary(false)[0];
                }
            } catch (Exception $e){
                $response['message'] = $e->getMessage();
            }
            echo Json::encode($response);
            exit();
        }

        return $this->renderAjax('signup', [
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
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException();
        }

        $form = new RecoverRequestForm();
        if ($form->load(Yii::$app->request->post()) && !Yii::$app->request->getBodyParam('only_render')) {
            $response = [
                'success' => false,
                'message' =>
                    Yii::t('common', 'Өкінішке орай аккаунтты қалпына келтіре алмаймыз.'),
            ];
            try {
                if ($form->validate()) {
                    $this->recoverService->sendEmail($form->getUser());
                    $response['success'] = true;
                    $response['message'] = Yii::t('common', 'Келесі нұсқаулар алу үшін электрондық поштаны тексеріңіз.');
                } else {
                    $response['message'] = $form->getErrorSummary(false)[0];
                }
            } catch (Exception $e) {
                $response['message'] = $e->getMessage();
            }
            echo Json::encode($response);
            exit();
        }

        return $this->renderAjax('recoverRequest', [
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

    public function actionGoogleLogin($returnUrl): Response
    {
        try {
            return $this->redirect($this->oauthGoogleService->getAuthorizationUrl($returnUrl));
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect('/');
        }
    }

    public function actionGoogleCallback(): Response
    {
        $form = new OauthCallbackForm();

        if ($form->load(Yii::$app->request->getQueryParams(), '') && $form->validate()) {
            try {
                $authInfo = $this->oauthGoogleService->getAuthorizationData($form->code);
                $user = UserIdentity::findOne(['email' => $authInfo['email']]);
                if (!$user) {
                    $user = $this->signupService->process([
                        'username' => $authInfo['email'],
                        'email' => $authInfo['email']
                    ], false);
                }
                Yii::$app->user->login($user);

                $returnUrl = Yii::$app->session->get("oauthReturnUrl");
                return $this->redirect($returnUrl);
            } catch (Exception $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->redirect('/');
    }
}
