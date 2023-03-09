<?php

namespace App\Services\Exchange;

class FormatToNumberPrecision
{
    public static function format($value)
    {
        $valueExplode = explode('.', $value);

        $newFloatValue = count($valueExplode) > 1 ? number_format($value, strlen($valueExplode[1])) : $value;
        return $newFloatValue;
    }
}
