<?php

namespace App\Services\Interfaces;

interface FetchInterface
{
    public static function start(string $url): ?string;
}
