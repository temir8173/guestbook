<?php

use yii\db\Migration;

/**
 * Class m230810_051432_refactor_payments
 */
class m230810_051432_refactor_payments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('orders', 'create_time', 'created_at');
        $this->alterColumn(
            'orders',
            'created_at',
            $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')
        );
        $this->alterColumn(
            'orders',
            'paid_time',
            $this->dateTime()->null()
        );
        $this->addColumn('orders', 'is_paid', $this->boolean()->defaultValue(false));

        $this->createTable('payments', [
            'id' => $this->primaryKey(),
            'payment_id' => $this->bigInteger(),
            'user_id' => $this->integer()->notNull(),
            'order_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'status' => $this->string()->defaultValue(0),
            'amount' => $this->string()->notNull(),
            'is_paid' => $this->boolean()->defaultValue(false),
            'completed_at' => $this->dateTime(),
            'desc' => $this->text(),
            'parent_id' => $this->integer(),
            'is_demo' => $this->boolean()->defaultValue(false),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('payments');
    }
}
