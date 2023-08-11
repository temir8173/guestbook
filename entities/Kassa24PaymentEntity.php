<?php

namespace app\entities;


class Kassa24PaymentEntity implements IPaymentEntity
{
    public function __construct(
        public int $orderId,
        public int $userId,
        public int $amount,
        public string $callbackUrl,
        public string $returnUrl,
        public ?int $paymentId = null,
        public string $description = '',
        public bool $demo = false,
        public ?string $email = null,
        public ?string $phone = null,
        public array $metadata = [],
    ) {}
}
