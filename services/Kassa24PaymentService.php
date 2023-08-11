<?php


namespace app\services;


use app\entities\Kassa24PaymentEntity;
use app\models\Invitation;
use app\repositories\OrderRepository;
use app\repositories\PaymentRepository;
use Exception;
use yii\helpers\Json;


class Kassa24PaymentService
{
    public const PAYMENT_CREATE_URL = 'https://ecommerce.pult24.kz/payment/create';
    public const REMOTE_IP = '35.157.105.64';

    public function __construct(
        private PaymentRepository $paymentRepository,
        private OrderRepository $orderRepository,
    ) {}

    /**
     * @throws Exception
     */
    public function create(Kassa24PaymentEntity $entity, string $login, string $password)
    {
        if ($entity->amount <= 0){
            throw new Exception('цена не указана или меньше 0');
        }

        $dataArray = [
            'orderId' => (string)$entity->orderId,
            'merchantId' => $login,
            'amount' => $entity->amount,
            'callbackUrl' => $entity->callbackUrl,
            'description' => $entity->description,
            'demo' => true, //$entity->demo,
            'returnUrl' => $entity->returnUrl,
        ];

        if ($entity->email || $entity->phone){
            $dataArray['customerData'] = [
                'email' => $entity->email ?? '',
                'phone' => $entity->phone ?? ''
            ];
        }

        if (!empty($entity->metadata)) {
            $dataArray['metadata'] = $entity->metadata;
        }

        $data_string = JSON::encode($dataArray, JSON_UNESCAPED_UNICODE);
        $curl = curl_init( self::PAYMENT_CREATE_URL);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        $headers = [
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode($login . ':' . $password),
            'Content-Length: ' . strlen($data_string)
        ];
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($curl);
        curl_close($curl);

        return JSON::decode($result);
    }

    /**
     * @throws \yii\db\Exception
     */
    public function processResponse(array $response): bool
    {
        if ((int)$response['status'] === 1) {
            try {
                // todo: surround by transaction
                $this->orderRepository->setPaid((int)$response['orderId']);
                $this->paymentRepository->setPaid($response['id']);

                /** @var Invitation $invitation */
                $invitation = Invitation::find()
                    ->joinWith('order')
                    ->where(['orders.id' => (int)$response['orderId']])
                    ->one();
                $invitation->status = Invitation::STATUS_PAID;
                $invitation->save(false);
            } catch (Exception $e) {
                return false;
            }
        }

        return true;
    }
}
