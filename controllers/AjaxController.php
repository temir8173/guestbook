<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Messages;
use app\models\FieldValues;
use yii\helpers\Json;

class AjaxController extends Controller
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

    public function actionGetMessages()
    {

        $messages = Messages::find()->orderBy(['date' => SORT_ASC])->all();

        if (Yii::$app->request->isAjax) {

            return $this->renderAjax('@app/modules/invitations/views/default/_messages.php', [
                'messages' => $messages
            ]);

        } else {
            throw new \yii\web\HttpException(404,'Страница не найдена');
        }
        
    }

    public function actionAddMessage()
    {
        if (Yii::$app->request->isAjax) {

            $newMessage = new Messages();
            $return = array(
                'error' => 1,
                'message' => 'Ошибка. Неверный формат данных!',
            );

            if ($newMessage->load(Yii::$app->request->post()) && $newMessage->save()) {
                $return = array(
                    'error' => 0,
                    'message' => 'Ваше сообщение было успешно добавлено!',
                );
            }
            return Json::encode($return);

        } else {
            throw new \yii\web\HttpException(404,'Страница не найдена');
        }
    }

    public function actionDeleteImage()
    {
        if (Yii::$app->request->isAjax) {
            $params = Yii::$app->request->post();
            $fieldValue = FieldValues::findOne($params['id']);
            $fieldValue->deleteImage($params['index']);
        }

    }
}
