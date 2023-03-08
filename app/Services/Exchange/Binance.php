<?php

namespace App\Services\Exchange;

use App\Services\Exchange\Interfaces\CoinInterface;

class Binance extends Brokers
{
    private $url = "https://api.binance.com/api/v3/ticker/24hr";

    public function __construct()
    {
        parent::__construct($this->url);
    //     0 => array:21 [▼
    //     "symbol" => "ETHBTC"
    //     "priceChange" => "-0.00013700"
    //     "priceChangePercent" => "-0.195"
    //     "weightedAvgPrice" => "0.07006790"
    //     "prevClosePrice" => "0.07013600"
    //     "lastPrice" => "0.06999900"
    //     "lastQty" => "0.00150000"
    //     "bidPrice" => "0.06999900"
    //     "bidQty" => "28.15800000"
    //     "askPrice" => "0.07000000"
    //     "askQty" => "23.17040000"
    //     "openPrice" => "0.07013600"
    //     "highPrice" => "0.07040300"
    //     "lowPrice" => "0.06951300"
    //     "volume" => "101638.73950000"
    //     "quoteVolume" => "7121.61332139"
    //     "openTime" => 1677793039155
    //     "closeTime" => 1677879439155
    //     "firstId" => 405009606
    //     "lastId" => 405197773
    //     "count" => 188168
    //   ]
    }

    public function processData(CoinInterface $coin)
    {
        if ($this->jsonObject == null) {
            return;
        }

        foreach ($this->jsonObject as $dataCoin) {
            $coinCopy = clone $coin;
            $coinCopy->create(
                $dataCoin["symbol"],
                $dataCoin["lastPrice"],
                $dataCoin["priceChange"],
                $dataCoin["priceChangePercent"],
                $dataCoin["highPrice"],
                $dataCoin["lowPrice"],
                $dataCoin["quoteVolume"],
            );
            $this->addCoin($coinCopy);
        }
    }
}
