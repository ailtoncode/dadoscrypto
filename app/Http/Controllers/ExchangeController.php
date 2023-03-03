<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Exchange\Gate;
use App\Services\Exchange\Coin;
use App\Models\Symbol;
use App\Models\Broker;

class ExchangeController extends Controller
{
    public function symbols()
    {
        $coin = new Coin();
        $gate = new Gate("https://api.gateio.ws/api/v4/spot/tickers");
        $gate->processData($coin);

        $broker = Broker::where('name', 'gate')->first();
        foreach ($gate->getAllSymbols() as $value) {
            if (!isset($broker->id)) {
                break;
            }
            $symbol["name"] = $value;
            $symbol["id_broker"] = $broker->id;
            Symbol::create($symbol);
        }
        return dd($broker);
    }
}
