<?php

namespace App\Helpers;

use InvalidArgumentException;

class IPFormatter
{
    public static function format(string $ip): string
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return self::formatIPv4($ip);
        }
        return $ip;
    }

    private static function formatIPv4(string $ip): string
    {
        $parts = explode('.', $ip);
        $formatted = [];
        foreach ($parts as $part) {
            $formatted[] = self::padPart($part);
        }

        return implode(' .', $formatted);
    }

    private static function padPart(string $part): string
    {
        return str_pad($part, 3, '0', STR_PAD_LEFT);
    }
}
