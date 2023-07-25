<?php


namespace app\lists;


use Yii;

class GuestAnswersList
{
    public const YES = 'yes';
    public const MAYBE = 'maybe';
    public const NO = 'no';

    public static function getAll(): array
    {
        return [
            self::YES => Yii::t('common', 'Иә, міндетті түрде'),
            self::MAYBE => Yii::t('common', 'Әзірге белгісіз'),
            self::NO => Yii::t('common', 'Жоқ, өкінішке орай келе алмаймын'),
        ];
    }

    public static function getShortTranslation(string $answer): string
    {
        $translations = [
            self::YES => Yii::t('common', 'Иә'),
            self::MAYBE => Yii::t('common', 'Белгісіз'),
            self::NO => Yii::t('common', 'Жоқ'),
        ];

        return $translations[$answer] ?? $answer;
    }
}