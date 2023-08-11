<?php


namespace app\repositories;


use yii\db\Exception;
use yii\db\Expression;
use yii\db\Query;

class OrderRepository
{
    /**
     * @throws Exception
     */
    public function setPaid(int $orderId)
    {
        (new Query())->createCommand()
            ->update('orders', [
                'paid_time' => new Expression('NOW()'),
                'status' => 1,
                'is_paid' => true
            ], ['id' => $orderId])
        ->execute();
    }
}
