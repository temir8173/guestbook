<?php

use yii\db\Migration;

/**
 * Class m230802_051302_add_name_rus_to_field
 */
class m230802_051302_add_name_rus_to_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('fields', 'name_rus', $this->string()->null()->after('name'));
        $this->addColumn('sections', 'name_rus', $this->string()->null()->after('name'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
