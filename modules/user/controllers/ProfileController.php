<?php

namespace app\modules\user\controllers;

use Yii;
use app\models\User;
use app\models\ResetPasswordForm;
// use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ManageController implements the CRUD actions for User model.
 */
class ProfileController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'reset-password'],
                        'roles' => ['user'],
                    ],
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $user = User::findOne(Yii::$app->user->id);
        $resetPwdForm = new ResetPasswordForm('default');

        $this->layout = '@app/modules/manage/views/layouts/manage';
        return $this->render('index', [
            'user' => $user,
            'resetPwdForm' => $resetPwdForm
        ]);
    }
    
    public function actionResetPassword()
    {
        $resetPwdForm = new ResetPasswordForm('default');
        if ($resetPwdForm->load(Yii::$app->request->post()) && $resetPwdForm->validate()) {
            $resetPwdForm->resetPasswordByProfile();
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->goBack();
        } else {
            $user = User::findOne(Yii::$app->user->id);
            $this->layout = '@app/modules/manage/views/layouts/manage';
            return $this->render('index', [
                'user' => $user,
                'resetPwdForm' => $resetPwdForm
            ]);
        }
    }

}