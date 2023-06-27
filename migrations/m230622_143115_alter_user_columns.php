<?php

use yii\db\Migration;

/**
 * Class m230622_143115_alter_user_columns
 */
class m230622_143115_alter_user_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn(
            'user',
            'created_at',
            $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')
        );
        $this->alterColumn(
            'user',
            'updated_at',
            $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
