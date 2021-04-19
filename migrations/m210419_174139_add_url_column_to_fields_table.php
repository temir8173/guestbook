<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%fields}}`.
 */
class m210419_174139_add_url_column_to_fields_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%fields}}', 'url', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%fields}}', 'url');
    }
}
