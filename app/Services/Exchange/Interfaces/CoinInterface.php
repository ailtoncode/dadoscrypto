<?php

namespace App\Services\Exchange\Interfaces;

interface CoinInterface
{
    public function create(
        string $symbol,
        string $lastPrice,
        string $variation,
        string $variationPercent,
        string $maximum,
        string $minimum,
        string $volume
    );

    public function getSymbol();

    public function getLastPrice();
}
