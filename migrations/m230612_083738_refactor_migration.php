<?php

use yii\db\Migration;

/**
 * Class m230612_083738_refactor_migration
 */
class m230612_083738_refactor_migration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('sections');
        $this->dropTable('field_values');
        $this->renameTable('section_templates', 'sections');
        $this->renameColumn('fields', 'section_template_id', 'section_id');
        $this->renameColumn('sections', 'view', 'slug');
        $this->createTable('templates', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(64)->notNull(),
            'name' => $this->string(64)->notNull(),
            'preview' => $this->string(255)->notNull(),
        ]);
        $this->renameColumn('invitations', 'template', 'template_id');
        $this->addColumn('invitations', 'sections', 'JSON');
        $this->addColumn('invitations', 'field_values', 'JSON');
        $this->renameTable('messages', 'wishes');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('templates');

        return true;
    }
}
