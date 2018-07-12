<?php

namespace App\Helpers;

class KeySignHelper
{
    const KEY_SIGN = '*';

    public static function hasKeySign(string $text): bool
    {
        return str_contains($text, self::KEY_SIGN);
    }

    public static function hasTriggerSign(string $text): bool
    {
        return mb_substr($text, 0, 1) == self::KEY_SIGN;
    }

    public static function cutTriggerSign(string $text): string
    {
        if (!self::hasTriggerSign($text)) {
            return $text;
        }

        return mb_substr($text, 1);
    }
}
