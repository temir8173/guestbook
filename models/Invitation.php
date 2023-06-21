<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\UploadedFile;

/**
 * This is the model class for table "invitations".
 *
 * @property int $id
 * @property string $url
 * @property string $name
 * @property int $template_id
 * @property int $event_date
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 * @property int $user_id
 * @property string $sections
 * @property string $field_values
 *
 * @property Wish[] $wishes
 * @property Template $template
 */
class Invitation extends ActiveRecord
{
    public const PRICE = 5000;

    public const STATUS_UNPAID = 0;
    public const STATUS_PAID = 1;

    public const TEMPLATE_1 = 'template1';
    public const TEMPLATE_2 = 'template2';
    public const TEMPLATE_RUSLAN = 'template-ruslan';
    public const TEMPLATE_NABAT = 'template-nabat';

    public static function getTemplates()
    {
        return [
            self::TEMPLATE_1 => 'template1', 
            self::TEMPLATE_2 => 'template2',
            self::TEMPLATE_RUSLAN => 'Шаблон - Руслан',
            self::TEMPLATE_NABAT => 'Шаблон - Набат',
        ];
    }

    public static function getStatusLabels()
    {
        return [
            self::STATUS_UNPAID => 'Төленбеген',
            self::STATUS_PAID => 'Төленген',
        ];
    }

    public array $files = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'invitations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['url', 'name', 'template_id', 'event_date'], 'required'],
            [['status', 'user_id'], 'integer'],
            [['url', 'name', 'template_id'], 'string', 'max' => 255],
            [['url'], 'unique'],
            [['status'], 'default', 'value' => 0],
            [['sections', 'field_values'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'name' => Yii::t('common', 'Аты'),
            'event_date' => Yii::t('common', 'Өткізілетін уақыты'),
            'created_at' => 'Created Date',
            'updated_date' => 'Updated Date',
            'template_id' => 'Шаблон',
            'status' => Yii::t('common', 'Төлем'),
            'user_id' => Yii::t('common', 'Пайдаланушы'),
        ];
    }

    public function getWishes(): ActiveQuery
    {
        return $this->hasMany(Wish::class, ['invitation_id' => 'id']);
    }

    public function getTemplate(): ActiveQuery
    {
        return $this->hasOne(Template::class, ['id' => 'template_id']);
    }

    public function load($data, $formName = null): bool
    {
        $this->sections = $data['Section']['slug'] ?? [];

        if (!empty($data['Field'])) {
            $this->field_values = $this->prepareFields($data['Field']);
        }

        return parent::load($data, $formName);
    }

    /**
     * todo: перенести в сервис
    */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $order = new Orders();
            $order->user_id = Yii::$app->user->id;
            $order->invitation_id = $this->id;
            $order->price = self::PRICE;
            $order->create_time = time();
            $order->paid_time = '';
            $order->status = 0;
            $order->save();
        } else {
            // var_dump('expression');die;
            // Нет, старая (update)
        }
        parent::afterSave($insert, $changedAttributes);
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
                $this->files[$slug] = UploadedFile::getInstancesByName("Field[$slug]");
                $fieldValue = $this->field_values[$slug] ?? [];
            }
            $newFields[$slug] = $fieldValue;
        }

        return $newFields;
    }
}
