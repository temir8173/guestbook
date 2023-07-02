<?php

use yii\db\Migration;

/**
 * Class m230622_063749_add_fields_to_section_and_fields
 */
class m230622_063749_add_fields_to_section_and_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('sections', 'is_optional', $this->boolean()->defaultValue(false));
        $this->addColumn('fields', 'hint', $this->text()->null());
        $this->addColumn('fields', 'default_value', $this->text()->null());
        $this->addColumn('templates', 'sections', 'JSON');
        $this->renameColumn('templates', 'preview', 'preview_img');
        $this->addColumn('templates', 'price', $this->integer()->defaultValue(5000));
        $this->addColumn('templates', 'type', $this->string(32)->defaultValue('marriage'));
        $this->addColumn('invitations', 'is_demo', $this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
