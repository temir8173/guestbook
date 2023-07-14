<?php

namespace app\lists;

use Yii;

class TemplateTypesList
{
    public const MARRIAGE = 'marriage';
    public const GIRL_MARRIAGE = 'girlMarriage';

    public static function getAll(): array
    {
        return [
            self::MARRIAGE => Yii::t('common', 'Үйлену тойы'),
            self::GIRL_MARRIAGE => Yii::t('common', 'Ұзату той'),
        ];
    }

    public static function getName(string $key): ?string
    {
        return self::getAll()[$key] ?? null;
    }
}
