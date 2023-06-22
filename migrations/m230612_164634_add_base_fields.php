<?php

use app\models\Field;
use yii\db\Migration;

/**
 * Class m230612_164634_add_base_fields
 */
class m230612_164634_add_base_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('fields', 'url', 'slug');
        $fields = [
            [
                'name' => 'Шақыру сөздері',
                'section_id' => 1,
                'type' => Field::TYPE_TEXTAREA,
                'slug' => 'invite_words',
            ],
            [
                'name' => 'Той иелері',
                'section_id' => 1,
                'type' => Field::TYPE_TEXT,
                'slug' => 'wedding_owners',
            ],
            [
                'name' => 'Love-story тақырыбы(заголовок)',
                'section_id' => 2,
                'type' => Field::TYPE_TEXT,
                'slug' => 'lovestory_section_name',
            ],
            [
                'name' => 'Love-story-ға сілтеме(youtube)',
                'section_id' => 2,
                'type' => Field::TYPE_YOUTUBE,
                'slug' => 'lovestory_video_url',
            ],
            [
                'name' => 'Өткізілетін орын секциясының тақырыбы',
                'section_id' => 3,
                'type' => Field::TYPE_TEXT,
                'slug' => 'place_section_name',
            ],
            [
                'name' => 'Өткізілетін орынның аты',
                'section_id' => 3,
                'type' => Field::TYPE_TEXT,
                'slug' => 'place_restaurant',
            ],
            [
                'name' => 'Өткізілетін орынның адресі',
                'section_id' => 3,
                'type' => Field::TYPE_TEXT,
                'slug' => 'place_address',
            ],
            [
                'name' => 'Өткізілетін орын картада',
                'section_id' => 3,
                'type' => Field::TYPE_MAP,
                'slug' => 'place_map_widget',
            ],
            [
                'name' => 'Тойдан естелік',
                'section_id' => 4,
                'type' => Field::TYPE_CLOUD_LINK,
                'slug' => 'memory_links',
            ],
            [
                'name' => 'Галерея секциясының тақырыбы',
                'section_id' => 5,
                'type' => Field::TYPE_TEXT,
                'slug' => 'gallery_name',
            ],
            [
                'name' => 'Галерея фотолары',
                'section_id' => 5,
                'type' => Field::TYPE_IMAGE,
                'slug' => 'gallery_images',
            ],
            [
                'name' => 'Тілектер секциясының тақырыбы',
                'section_id' => 6,
                'type' => Field::TYPE_TEXT,
                'slug' => 'wishes_name',
            ],
        ];

        foreach ($fields as $field) {
            $model = new Field();
            $model->setAttributes($field, false);
            $model->save(false);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
