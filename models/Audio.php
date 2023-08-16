<?php


namespace app\models;


use app\lists\TemplateTypesList;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;


/**
 * @property int $id
 * @property string $name
 * @property string $path
 * @property string $type
 * @property string $translatedType
 * @property string $audio
*/
class Audio extends ActiveRecord
{
    public const AUDIO_PATH = 'uploads/audio/';

    public static function tableName(): string
    {
        return 'audio';
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['type'], 'string', 'max' => 32],
            [['path', 'name'], 'string', 'max' => 255],
        ];
    }

    public function getTranslatedType(): string
    {
        return TemplateTypesList::getName($this->type);
    }

    public function getAudio(): string
    {
        return '/' . self::AUDIO_PATH . $this->path;
    }

    public function save($runValidation = true, $attributeNames = null): bool
    {
        $audioFiles = UploadedFile::getInstancesByName('Audio[path]');
        $audioFile = $audioFiles[0] ?? null;
        $name = null;
        if ($audioFile) {
            $name = preg_replace("/\s+/", "_", $audioFile->baseName)
                . '.' . $audioFile->extension;
            $audioFile->saveAs(self::AUDIO_PATH . $name);
        }
        $this->path = $name ?? $this->oldAttributes['path'] ?? '';

        return parent::save($runValidation, $attributeNames);
    }
}
