<?php


namespace app\helpers;


class CloudServiceHelper
{
    public const GOOGLE_DRIVE = 'google';
    public const YANDEX_DISK = 'yandex';
    public const MAILRU = 'mailru';

    public static function detectType(string $url): string
    {
        if (preg_match('#https://drive\.google\.com/#', $url)) {
            $type = self::GOOGLE_DRIVE;
        } elseif (preg_match('#https://disk\.yandex#', $url)) {
            $type = self::YANDEX_DISK;
        } elseif (preg_match('#https://cloud\.mail\.ru#', $url)) {
            $type = self::MAILRU;
        }

        return $type ?? self::GOOGLE_DRIVE;
    }
}