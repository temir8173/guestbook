<?php

namespace app\helpers;

use app\models\Invitations;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class InvitationsHelper
{
    public static function statusList(): array
    {
        return [
            Invitations::STATUS_UNPAID => 'Төленбеді',
            Invitations::STATUS_PAID => 'Төленді',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case Invitations::STATUS_UNPAID:
                $class = 'label label-danger';
                break;
            case Invitations::STATUS_PAID:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}