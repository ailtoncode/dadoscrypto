<?php

namespace App\Services\Exchange;

use App\Services\Exchange\Interfaces\CoinInterface;
use App\Services\FetchCurl;

abstract class Brokers
{
    private $coin = [];
    protected $jsonObject;

    public function __construct($url)
    {
        $this->jsonObject = json_decode(FetchCurl::start($url), true);
    }

    abstract public function processData(CoinInterface $coin);

    public function getAllCoins()
    {
        return $this->coin;
    }

    public function getAllSymbols(): array
    {
        $symbols = [];
        foreach ($this->coin as $coin) {
            $symbols[] = $coin->getSymbol();
        }
        return $symbols;
    }

    protected function addCoin(CoinInterface $coin)
    {
        $this->coin[] = $coin;
    }
}
