<?php

use yii\db\Migration;

/**
 * Class m230614_071556_alter_invitations_date_fields
 */
class m230614_071556_alter_invitations_date_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('invitations', 'created_date', 'created_at');
        $this->renameColumn('invitations', 'updated_date', 'updated_at');
        $this->alterColumn(
            'invitations',
            'created_at',
            $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')
        );
        $this->alterColumn(
            'invitations',
            'updated_at',
            $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
        );
        $this->alterColumn(
            'invitations',
            'event_date',
            $this->date()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
