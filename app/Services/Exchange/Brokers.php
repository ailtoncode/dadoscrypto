<?php

namespace App\Services\Exchange;

use App\Services\Exchange\Interfaces\CoinInterface;
use App\Services\FetchCurl;

abstract class Brokers
{
    protected $coin;
    protected $jsonObject;

    public function __construct($url)
    {
        //$this->jsonObject = json_decode(FetchCurl::start($url), true);
        $this->jsonObject[] = [
            "currency_pair" => 'BTC_USDT',
            "last" => 1.75
        ];
    }

    abstract public function processData(CoinInterface $coin);

    public function getAllCoins()
    {
        return $this->coin;
    }

    public function getAllSymbols()
    {
        $symbols = [];
        foreach ($this->coin as $coin) {
            $symbols[] = $coin->getSymbol();
        }
        return $symbols;
    }
}
