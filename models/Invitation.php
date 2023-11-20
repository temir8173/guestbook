<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "invitations".
 *
 * @property int $id
 * @property string $url
 * @property string $name
 * @property string $locale
 * @property string $image
 * @property string $audio
 * @property int $template_id
 * @property int $event_date
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 * @property int $user_id
 * @property array $sections
 * @property array $field_values
 * @property boolean $is_demo
 * @property boolean $is_deleted
 *
 * @property Wish[] $wishes
 * @property Template $template
 * @property Orders $order
 * @property User $user
 */
class Invitation extends ActiveRecord
{
    public const PRICE = 5000;

    public const STATUS_UNPAID = 0;
    public const STATUS_PAID = 1;

    public const MAX_FILES_COUNT = 3;

    public static function getStatusLabels(): array
    {
        return [
            self::STATUS_UNPAID => 'Төленбеген',
            self::STATUS_PAID => 'Төленген',
        ];
    }

    /**
     * @var UploadedFile[][] $files
    */
    public array $files = [];

    /**
     * @var ?UploadedFile $imageFile
    */
    public ?UploadedFile $imageFile = null;

    public static function tableName(): string
    {
        return 'invitations';
    }

    public function rules(): array
    {
        return [
            [['url', 'name', 'template_id', 'event_date', 'locale'], 'required'],
            [['status', 'user_id', 'template_id'], 'integer'],
            [['url', 'name', 'image', 'audio'], 'string', 'max' => 255],
            [['url'], 'unique'],
            [['status'], 'default', 'value' => 0],
            [['sections', 'field_values', 'is_demo', 'is_deleted'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'name' => Yii::t('common', 'Аты'),
            'locale' => Yii::t('common', 'Тіл'),
            'image' => Yii::t('common', 'Сурет'),
            'audio' => Yii::t('common', 'Әуен'),
            'event_date' => Yii::t('common', 'Өткізілетін уақыты'),
            'created_at' => 'Created Date',
            'updated_at' => 'Updated Date',
            'template_id' => 'Шаблон',
            'status' => Yii::t('common', 'Төлем'),
            'user_id' => Yii::t('common', 'Пайдаланушы'),
        ];
    }

    public function getWishes(): ActiveQuery
    {
        return $this->hasMany(Wish::class, ['invitation_id' => 'id']);
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getTemplate(): ActiveQuery
    {
        return $this->hasOne(Template::class, ['id' => 'template_id']);
    }

    public function getOrder(): ActiveQuery
    {
        return $this->hasOne(Orders::class, ['invitation_id' => 'id']);
    }

    public function load($data, $formName = null): bool
    {
        $this->imageFile = UploadedFile::getInstancesByName("Invitation[image]")[0] ?? null;

        if (!empty($data['Section']['slug'])) {
            $this->sections = $data['Section']['slug'];
        }

        if (!empty($data['Field'])) {
            $this->field_values = $this->prepareFields($data['Field']);
        }

        return parent::load($data, $formName);
    }

    private function prepareFields(array $formFields): array
    {
        $fieldTypes = Field::find()->select(['slug', 'type'])->all();
        $fieldTypesBySlug = ArrayHelper::map($fieldTypes, 'slug', 'type');

        $newFields = [];
        foreach ($formFields as $slug => $fieldValue) {
            if ($fieldTypesBySlug[$slug] === Field::TYPE_YOUTUBE) {
                $parts = parse_url($fieldValue);
                if (!empty($parts['query'])) {
                    parse_str($parts['query'], $query);
                }
                $fieldValue = (isset($query['v']))
                    ? 'https://www.youtube.com/embed/'.$query['v']
                    : $fieldValue;
            } elseif ($fieldTypesBySlug[$slug] === Field::TYPE_IMAGE) {
                $filesCount = count($this->field_values[$slug] ?? []);
                $count = 0;
                $uploadFiles = UploadedFile::getInstancesByName("Field[$slug]");

                while (
                    $filesCount + $count < self::MAX_FILES_COUNT
                    && isset($uploadFiles[$count])
                    && $uploadFiles[$count]->size < 5 * 1024 * 1024
                ) {
                    $this->files[$slug][] = $uploadFiles[$count];
                    $count++;
                }

                $fieldValue = $this->field_values[$slug] ?? [];
            }
            $newFields[$slug] = $fieldValue;
        }

        return $newFields;
    }
}
