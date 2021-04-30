<?php

use yii\db\Migration;

/**
 * Class m210430_041725_add_user_email_confirm_token
 */
class m210430_041725_add_user_email_confirm_token extends Migration
{
    
    public function up()
    {
        $this->addColumn('{{%user}}', 'email_confirm_token', $this->string()->unique()->after('email'));
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'email_confirm_token');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210430_041725_add_user_email_confirm_token cannot be reverted.\n";

        return false;
    }
    */
}
