<?php

use yii\db\Migration;

/**
 * Class m230724_113852_add_answer_to_wish
 */
class m230724_113852_add_answer_to_wish extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('wishes', 'answer', $this->string(64)->null()->after('text'));
        $this->addColumn('invitations', 'is_deleted', $this->boolean()->notNull()->defaultValue(false));
        $this->addColumn(
            'invitations',
            'locale',
            $this->string()->notNull()->defaultValue('kk')->after('name')
        );
        $this->addColumn(
            'invitations',
            'image',
            $this->string()->after('locale')
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
