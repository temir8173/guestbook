<?php

use yii\db\Migration;

/**
 * Class m210425_144343_add_user_role_field
 */
class m210425_144343_add_user_role_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'role', $this->string(64));
        $this->update('{{%user}}', ['role' => 'user']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'role');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210425_144343_add_user_role_field cannot be reverted.\n";

        return false;
    }
    */
}
