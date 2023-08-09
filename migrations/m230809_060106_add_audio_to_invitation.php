<?php

use yii\db\Migration;

/**
 * Class m230809_060106_add_audio_to_invitation
 */
class m230809_060106_add_audio_to_invitation extends Migration
{
    public function safeUp()
    {
        $this->addColumn('invitations', 'audio', $this->string()->null()->after('image'));
    }

    public function safeDown()
    {
        return true;
    }
}
