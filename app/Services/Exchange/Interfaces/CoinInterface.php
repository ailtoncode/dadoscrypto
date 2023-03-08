<?php

namespace App\Services\Exchange\Interfaces;

interface CoinInterface
{
    public function create(
        string $symbol,
        float $lastPrice,
        float $variation,
        float $variationPercent,
        float $maximum,
        float $minimum,
        float $volume
    );

    public function getSymbol();

    public function getLastPrice();
}
