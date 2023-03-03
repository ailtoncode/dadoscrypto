<?php

namespace App\Services\Exchange\Interfaces;

interface CoinInterface
{
    public function create(
        string $symbol,
        float $lastPrice
    );

    public function getSymbol();

    public function getLastPrice();
}
