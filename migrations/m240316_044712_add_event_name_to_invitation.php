<?php

use yii\db\Migration;

/**
 * Class m240316_044712_add_event_name_to_invitation
 */
class m240316_044712_add_event_name_to_invitation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('invitations', 'event_name', $this->string(255)->null()->after('name'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('invitations', 'event_name');
    }
}
