<?php

namespace app\helpers;

use app\models\Invitation;
use Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class InvitationsHelper
{
    public static function statusList(): array
    {
        return [
            Invitation::STATUS_UNPAID => 'Төленбеді',
            Invitation::STATUS_PAID => 'Төленді',
        ];
    }

    /**
     * @throws Exception
     */
    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        $class = match ($status) {
            Invitation::STATUS_UNPAID => 'label label-danger',
            Invitation::STATUS_PAID => 'label label-success',
            default => 'label label-default',
        };

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}