<?php


namespace app\services;


use app\models\Orders;


class OrderService
{
    public function create(int $invitationId, int $userId, int $price)
    {
        $order = new Orders();
        $order->user_id = $userId;
        $order->invitation_id = $invitationId;
        $order->price = $price;
        $order->status = 0;
        $order->save();
    }
}
