<?php

use yii\db\Migration;

/**
 * Class m230701_061451_alter_wishes_date
 */
class m230701_061451_alter_wishes_date extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('wishes', 'date', 'created_at');
        $this->alterColumn(
            'wishes',
            'created_at',
            $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')
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
