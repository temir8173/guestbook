<?php

namespace app\controllers;

use app\models\Invitation;
use app\services\invitations\InvitationService;
use Yii;
use yii\filters\AccessControl;
use yii\rest\Controller;
use yii\filters\VerbFilter;
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
        ) {
            $this->invitationService->deleteImage($invitation, $fieldSlug, $imageName);
            $response['success'] = true;
        }

        return $response;
    }
}
