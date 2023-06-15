<?php

use yii\db\Migration;
use app\models\Section;

/**
 * Handles the creation of table `{{%section_templates}}`.
 */
class m210418_094555_create_section_templates_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%section_templates}}', [
            'id' => $this->primaryKey(),
            'view' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
        ]);

        $sections = [
            'speech' => 'Шақыру сөздері', 
            'love_story' => 'Love stroy', 
            'place' => 'Өткізу орны', 
            'memory' => 'Естелік', 
            'gallery' => 'Фотогалерея',
            'wishes' => 'Тілек-лебіздер',
        ];

        foreach ($sections as $view => $section) {
            $sectionExample = new Section();
            $sectionExample->view = $view;
            $sectionExample->name = $section;
            $sectionExample->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%section_templates}}');
    }
}
