<?php

namespace App\Services;

use App\Services\Interfaces\AlertInterface;

class Alert implements AlertInterface
{
    public static function success(string $message): string
    {
        return '<div class="message-success">' . $message . '</div>';
    }

    public static function error(string $message): string
    {
        return '<div class="message-error">' . $message . '</div>';
    }
}
