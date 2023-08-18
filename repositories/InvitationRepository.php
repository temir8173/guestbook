<?php


namespace app\repositories;


use yii\db\Expression;
use yii\db\Query;

class InvitationRepository
{
    public function updateDemoEventDate()
    {
        (new Query())->createCommand()
            ->update('invitations', [
                'event_date' => new Expression('DATE_ADD(event_date, INTERVAL 30 DAY)')
            ], [
                'is_demo' => true
            ])->execute();
    }
}