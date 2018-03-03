<?php

namespace App\Application\Helpers;

final class DataFilter
{
    /**
     * @param string $string
     * @return string
     */
    public static function deepTrimString(string $string): string
    {
        $string = trim($string);
        $string = trim($string, '"');
        $string = trim($string);

        return $string;
    }
}