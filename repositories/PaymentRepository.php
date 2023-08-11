<?php


namespace app\repositories;


use app\entities\IPaymentEntity;
use yii\db\Exception;
use yii\db\Expression;
use yii\db\Query;

class PaymentRepository
{
    /**
     * @throws Exception
     */
    public function create(IPaymentEntity $entity): int
    {
        return (new Query())->createCommand()
            ->insert('payments', [
                'payment_id' => $entity->paymentId,
                'user_id' => $entity->userId,
                'order_id' => $entity->orderId,
                'amount' => $entity->amount,
                'desc' => $entity->description,
                'is_demo' => $entity->demo,
            ])->execute();
    }

    /**
     * @throws Exception
     */
    public function setPaid(int $paymentId)
    {
        $id = $this->getLastWithSameId($paymentId);

        (new Query())->createCommand()
            ->update('payments', [
                'status' => 1,
                'is_paid' => true,
                'completed_at' => new Expression('NOW()'),
            ], ['id' => $id])
        ->execute();
    }

    private function getLastWithSameId(int $paymentId): int
    {
        return (int)(new Query())->select('id')
            ->from('payments')
            ->where(['payment_id' => $paymentId])
            ->orderBy('id DESC')
            ->scalar();
    }
}