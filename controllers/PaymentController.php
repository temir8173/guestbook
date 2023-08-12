<?php

namespace app\controllers;

use app\entities\Kassa24PaymentEntity;
use app\models\Orders;
use app\repositories\PaymentRepository;
use app\services\Kassa24PaymentService;
use Exception;
use Yii;
use yii\base\InvalidConfigException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class PaymentController extends Controller
{
    public function __construct(
        $id,
        $module,
        private Kassa24PaymentService $paymentService,
        private PaymentRepository $paymentRepository,

        $config = []
    ) {
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $this->enableCsrfValidation = false;

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
                        'actions' => ['pay'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'callback' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        var_dump('asdasd');die;
    }

    /**
     * @throws Exception
     */
    public function actionPay($orderId, $returnUrl)
    {
        /** @var Orders $order */
        $order = Orders::find()
            ->where(['id' => $orderId])
            ->andWhere(['user_id' => Yii::$app->user->id])
            ->one();

        if (!$order) {
            throw new NotFoundHttpException();
        }

        // если была попытка оплатить создаем новый заказ, так как касса24 выдает ошибку при повторной отправке с
        // одинаковым orderId
        if ($this->paymentRepository->exist($order->id)) {
            $newOrder = new Orders();

            $attributesToCopy = $order->getAttributes();
            unset($attributesToCopy['id']);
            $newOrder->setAttributes($attributesToCopy);
            $newOrder->save(false);
            $order = $newOrder;
        }

        $login = Yii::$app->params['kassa24Login'];
        $password = Yii::$app->params['kassa24Password'];
        $callbackUrl = Url::base(true) . '/payment/callback';

        $entity = new Kassa24PaymentEntity(
            orderId: $order->id,
            userId: Yii::$app->user->id,
            amount: $order->price * 100, // в тиынах
            callbackUrl: $callbackUrl,
            returnUrl: $callbackUrl,
            demo: true,
        );

        $result = $this->paymentService->create($entity, $login, $password);
        if (isset($result['url'])) {
            $entity->paymentId = (int)$result['id'];
            $this->paymentRepository->create($entity);
            $this->redirect($result['url']);
        } else {
            $this->redirect($returnUrl);
        }
    }

    /**
     * @throws InvalidConfigException|\yii\db\Exception
     */
    public function actionCallback(): array
    {
        $response = [
            'accepted' => false
        ];

        if (Yii::$app->request->getRemoteIP() !== Kassa24PaymentService::REMOTE_IP) {
            return $response;
        }

        $result = $this->paymentService->processResponse(Yii::$app->request->getBodyParams());

        $response['accepted'] = $result;
        return $response;
    }
}
