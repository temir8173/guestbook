<?php

use yii\db\Migration;
use app\models\User;

/**
 * Class m210428_055117_add_colums_to_user_table
 */
class m210428_055117_add_colums_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'password_reset_token', $this->string()->unique());
        $this->addColumn('{{%user}}', 'status', $this->smallInteger()->notNull()->defaultValue(10));
        $this->addColumn('{{%user}}', 'created_at', $this->integer()->notNull());
        $this->addColumn('{{%user}}', 'updated_at', $this->integer()->notNull());
        $this->addColumn('{{%user}}', 'email', $this->string()->unique());
        $users = User::find()->all();
        foreach ($users as $key => $user) {
            $user->email = $key.'example@test.kz';
            $user->save();
        }
        $this->alterColumn('{{%user}}','email', $this->string()->notNull());

        // Create admin user
        $user = new User();
        $user->username = 'admin';
        $user->password = '$2y$12$R2pq4l3wFKHUpMAp7irKYeVtyOCy78PxjSSPXVCp1cnBZdufZtrtu ';
        $user->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'password_reset_token');
        $this->dropColumn('{{%user}}', 'email');
        $this->dropColumn('{{%user}}', 'status');
        $this->dropColumn('{{%user}}', 'created_at');
        $this->dropColumn('{{%user}}', 'updated_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210428_055117_add_colums_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
