<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fields}}`.
 */
class m210405_062214_create_fields_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%fields}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'section_example_id' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%fields}}');
    }
}
