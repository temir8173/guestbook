<?php

use yii\db\Migration;

/**
 * Class m230702_151446_add_discount_column_to_templates
 */
class m230702_151446_add_discount_column_to_templates extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('templates', 'discount_price', $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
