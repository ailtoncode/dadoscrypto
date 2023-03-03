<?php

namespace App\Services\Exchange;

use App\Services\Exchange\Interfaces\CoinInterface;

class Coin implements CoinInterface
{
    private $symbol;
    private $lastPrice;

    public function create(string $symbol, float $lastPrice)
    {
        $this->symbol = $symbol;
        $this->lastPrice = $lastPrice;
    }

    public function getSymbol()
    {
        return $this->symbol;
    }

    public function getLastPrice()
    {
        return $this->lastPrice;
    }
}
