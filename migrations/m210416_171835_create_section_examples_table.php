<?php

use yii\db\Migration;
use app\models\SectionExamples;

/**
 * Handles the creation of table `{{%section_examples}}`.
 */
class m210416_171835_create_section_examples_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%section_examples}}', [
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
            $sectionExample = new SectionExamples();
            $sectionExample->view = $view;
            $sectionExample->name = $section;
            $sectionExample->save();
        }

        // Create admin user
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%section_examples}}');
    }
}
