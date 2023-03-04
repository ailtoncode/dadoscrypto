<?php

namespace App\Services\Interfaces;

interface AlertInterface
{
    public static function success(string $message): string;
    public static function error(string $message): string;
}
