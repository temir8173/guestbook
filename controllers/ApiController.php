<?php

namespace app\controllers;

use app\models\Invitation;
use app\services\invitations\InvitationService;
use Yii;
use yii\filters\AccessControl;
use yii\rest\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use app\models\Wish;
use yii\helpers\Json;
use yii\web\Response;

class ApiController extends Controller
{
    public function __construct(
        $id,
        $module,
        private InvitationService $invitationService,

        $config = []
    ) {
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;

        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
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

    public function actionGetMessages()
    {

        $messages = Wish::find()->orderBy(['date' => SORT_ASC])->all();

        if (Yii::$app->request->isAjax) {

            return $this->renderAjax('@app/modules/invitations/views/default/_messages.php', [
                'messages' => $messages
            ]);

        } else {
            throw new HttpException(404,'Страница не найдена');
        }
        
    }

    public function actionAddMessage()
    {
        if (Yii::$app->request->isAjax) {

            $newMessage = new Wish();
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
            throw new HttpException(404,'Страница не найдена');
        }
    }

    public function actionDeleteImage(): array
    {
        $response = array(
            'success' => false,
            'message' => '',
        );
        $invitationId = Yii::$app->request->post('invitation_id');
        $fieldSlug = Yii::$app->request->post('field_slug');
        $imageName = Yii::$app->request->post('image_name');
        $invitation = Invitation::findOne($invitationId);

        if (
            $invitation
            && Yii::$app->request->isAjax
            && file_exists(Yii::getAlias('@webroot') . '/uploads/' . $imageName)
        ) {
            $this->invitationService->deleteImage($invitation, $fieldSlug, $imageName);
            $response['success'] = true;
        }

        return $response;
    }
}
