<?php

namespace App\Services\Exchange;

use App\Services\Exchange\Brokers;
use App\Services\Exchange\Interfaces\CoinInterface;

class Gate extends Brokers
{
    private $url = "https://api.gateio.ws/api/v4/spot/tickers";

    public function __construct()
    {
        parent::__construct($this->url);
    // 0 => {#283 ▼
    //     +"currency_pair": "BKC_USDT"
    //     +"last": "0.00001277"
    //     +"lowest_ask": "0.0000129"
    //     +"highest_bid": "0.00001255"
    //     +"change_percentage": "-4.84"
    //     +"change_utc0": "-5.82"
    //     +"change_utc8": "-5.89"
    //     +"base_volume": "951385715.28317"
    //     +"quote_volume": "12768.108847485"
    //     +"high_24h": "0.00001363"
    //     +"low_24h": "0.00001255"
    //   }
    }

    public function processData(CoinInterface $coin)
    {
        if ($this->jsonObject == null || !isset($this->jsonObject[0])) {
            return;
        }

        foreach ($this->jsonObject as $dataCoin) {
            $coinCopy = clone $coin;
            $coinCopy->create(
                str_replace('_', '', $dataCoin["currency_pair"]),
                $dataCoin["last"]
            );
            $this->addCoin($coinCopy);
        }
    }
}
