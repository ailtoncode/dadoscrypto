<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Exchange\Gate;
use App\Services\Exchange\Coin;
use App\Models\CurrencySymbol;
use App\Models\Broker;
use App\Models\CurrencyHistory;
use App\Services\Exchange\Binance;
use DateTime;

class ExchangeController extends Controller
{
    private $coin;
    private $brokers;

    public function __construct()
    {
        $this->coin = new Coin();
        $this->brokers['gate'] = new Gate();
        $this->brokers['binance'] = new Binance();
        $this->brokers = (object)$this->brokers;
    }

    public function symbols()
    {
        $this->brokers->gate->processData($this->coin);
        $this->brokers->binance->processData($this->coin);

        $gateSymbols = $this->brokers->gate->getAllSymbols();
        $binanceSymbols = $this->brokers->binance->getAllSymbols();

        $broker = Broker::where('name', 'gate')->first();
        foreach ($gateSymbols as $value) {
            $checkIfExists = CurrencySymbol::where('symbol', $value)->where('id_broker', $broker->id)->first();
            if (!$checkIfExists) {
                $symbol["symbol"] = $value;
                $symbol["id_broker"] = $broker->id;
                CurrencySymbol::create($symbol);
            }
        }

        $broker = Broker::where('name', 'binance')->first();
        foreach ($binanceSymbols as $value) {
            $checkIfExists = CurrencySymbol::where('symbol', $value)->where('id_broker', $broker->id)->first();
            if (!$checkIfExists) {
                $symbol["symbol"] = $value;
                $symbol["id_broker"] = $broker->id;
                CurrencySymbol::create($symbol);
            }
        }

        return dd([$this->brokers->binance->getAllSymbols()]);
    }

    public function store()
    {
        $this->brokers->gate->processData($this->coin);
        $this->brokers->binance->processData($this->coin);


        $allCoins = [];
        $brokerIdGate = Broker::where('name', 'gate')->first()->id;
        foreach ($this->brokers->gate->getAllCoins() as $coin) {
            $allCoins[] = [
            'created_at' => $coin->getDateTime(),
            'symbol' => $coin->getSymbol(),
            'price' => $coin->getLastPrice(),
            'variation' => $coin->getVariation(),
            'variation_percent' => $coin->getVariationPercent(),
            'maximum' => $coin->getMaximum(),
            'minimum' => $coin->getMinimum(),
            'volume'  => $coin->getVolume()
            ];
        }

        $data = [
            'data_json' => json_encode($allCoins),
            'id_broker' => $brokerIdGate
        ];

        CurrencyHistory::create($data);

        $allCoins = [];
        $brokerIdBinance = Broker::where('name', 'binance')->first()->id;
        foreach ($this->brokers->binance->getAllCoins() as $coin) {
            $allCoins[] = [
            'created_at' => $coin->getDateTime(),
            'symbol' => $coin->getSymbol(),
            'price' => $coin->getLastPrice(),
            'variation' => $coin->getVariation(),
            'variation_percent' => $coin->getVariationPercent(),
            'maximum' => $coin->getMaximum(),
            'minimum' => $coin->getMinimum(),
            'volume'  => $coin->getVolume()
            ];
        }

        $data = [
            'data_json' => json_encode($allCoins),
            'id_broker' => $brokerIdBinance
        ];

        CurrencyHistory::create($data);
    }
}
