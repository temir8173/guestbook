<?php

use yii\db\Migration;

/**
 * Class m240422_181420_add_is_deprecated_col
 */
class m240422_181420_add_is_deprecated_col extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('templates', 'is_deprecated', $this->boolean()->defaultValue(false));
        $this->update('templates', ['is_deprecated' => true]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('templates', 'is_deprecated');
    }
}
