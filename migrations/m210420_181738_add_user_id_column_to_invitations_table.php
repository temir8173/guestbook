<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%invitations}}`.
 */
class m210420_181738_add_user_id_column_to_invitations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%invitations}}', 'user_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%invitations}}', 'user_id');
    }
}
