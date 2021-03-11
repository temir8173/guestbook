<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%messages}}`.
 */
class m210311_095914_create_messages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%messages}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull(),
            'message' => $this->string()->notNull(),
            'date' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-messages-date',
            'messages',
            'date'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%messages}}');
    }
}
