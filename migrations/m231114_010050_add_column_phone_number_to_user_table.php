<?php

use yii\db\Migration;

/**
 * Class m231114_010050_add_column_phone_number_to_user_table
 */
class m231114_010050_add_column_phone_number_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'phone_number', $this->string(12)->null()->after('username'));
        $this->addColumn('user', 'sms_code', $this->string(4)->null()->after('phone_number'));
        $this->dropIndex('email_confirm_token', 'user');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'phone_number');
        $this->dropColumn('user', 'sms_code');
        $this->createIndex('email_confirm_token', 'user', 'email_confirm_token');
    }
}
