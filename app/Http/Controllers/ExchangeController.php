<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Exchange\Gate;
use App\Services\Exchange\Coin;
use App\Models\Symbol;
use App\Models\Broker;
use App\Services\Exchange\Binance;

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
            $symbol["symbol"] = $value;
            $symbol["id_broker"] = $broker->id;
            Symbol::create($symbol);
        }

        $broker = Broker::where('name', 'binance')->first();
        foreach ($binanceSymbols as $value) {
            $symbol["symbol"] = $value;
            $symbol["id_broker"] = $broker->id;
            Symbol::create($symbol);
        }

        return dd([$this->brokers->binance->getAllSymbols()]);
    }
}
