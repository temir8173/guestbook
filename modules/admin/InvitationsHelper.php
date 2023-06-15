<?php

namespace common\helpers;

use app\models\Invitation;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

namespace app\modules\admin;

use app\models\Invitation;

class InvitationsHelper
{
    public static function statusList(): array
    {
        return [
            Invitation::STATUS_UNPAID => 'Төленбеді',
            Invitation::STATUS_PAID => 'Төленді',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case Post::STATUS_DRAFT:
                $class = 'label label-danger';
                break;
            case Post::STATUS_PUBLISH:
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