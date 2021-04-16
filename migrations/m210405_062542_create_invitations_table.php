<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%invitations}}`.
 */
class m210405_062542_create_invitations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%invitations}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'template' => $this->string()->notNull(),
            'event_date' => $this->integer()->notNull(),
            'created_date' => $this->integer()->notNull(),
            'updated_date' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%invitations}}');
    }
}
