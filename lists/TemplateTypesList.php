<?php

namespace app\lists;

use Yii;

class TemplateTypesList
{
    public const MARRIAGE = 'marriage';
    public const GIRL_MARRIAGE = 'girlMarriage';
    public const EVENT = 'event';

    public static function getAll(): array
    {
        return [
            self::MARRIAGE => Yii::t('common', 'Үйлену тойы'),
            self::GIRL_MARRIAGE => Yii::t('common', 'Ұзату той'),
            self::EVENT => Yii::t('common', 'Шаралар'),
        ];
    }

    public static function getName(string $key): string
    {
        return self::getAll()[$key] ?? $key;
    }
}
