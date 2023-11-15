<?php

use yii\db\Migration;

/**
 * Class m231115_073350_make_user_email_nullable
 */
class m231115_073350_make_user_email_nullable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('user', 'email', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
