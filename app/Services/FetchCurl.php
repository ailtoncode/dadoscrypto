<?php

namespace App\Services;

use App\Services\Interfaces\FetchInterface;

class FetchCurl implements FetchInterface
{
    public static function start(string $url): ?string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }
}
