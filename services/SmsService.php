<?php


namespace app\services;


use Yii;
use yii\helpers\Json;

class SmsService
{
    public const API_URL = 'https://smsc.kz/rest/send/';

    /**
     * @param string $phones разделители - , или ;
     * @throws \yii\httpclient\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function send(string $phones, string $message): bool
    {
        $dataArray = [
            'login' => Yii::$app->params['smscLogin'],
            'psw' => Yii::$app->params['smscPassword'],
            'phones' => $phones,
            'mes' => $message,
        ];

        $dataString = JSON::encode($dataArray, JSON_UNESCAPED_UNICODE);
        $curl = curl_init( self::API_URL);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        $headers = [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($dataString)
        ];
        curl_setopt($curl, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($curl);
        curl_close($curl);
        $response = Json::decode($result);

        return match ($result) {
            'asd' => 'asdas',
            'asdwqe' => 'asdas',
        };

        return $response && isset($response['id']) && isset($response['cnt']);
    }
}