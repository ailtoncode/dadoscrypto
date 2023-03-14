<?php

namespace App\Http\Controllers;

use App\Models\CurrencySymbol;
use App\Models\UserCurrency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function searchCurrency(Request $request)
    {
        if (!$request->ajax()) {
            return redirect(route('dashboard.index'));
        }

        $currencySymbols = DB::table('currency_symbols')
        ->join('brokers', 'currency_symbols.id_broker', '=', 'brokers.id')
        ->where('currency_symbols.symbol', 'LIKE', '%' . $request->term . '%')
        ->select([
            'brokers.id AS brokerId',
            'brokers.name AS brokerName',
            'currency_symbols.id AS currencyId',
            'currency_symbols.symbol AS currencySymbol'
        ])
        ->limit(10)->get();
        return Response()->json([
            'searchResult' => view('dashboard.fragments.search-currency', compact('currencySymbols'))->render()
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userCurrencySymbols = DB::table('currency_symbols')
        ->join('brokers', 'currency_symbols.id_broker', '=', 'brokers.id')
        ->join('user_currency', 'user_currency.id_currency_symbol', '=', 'currency_symbols.id')
        ->where('user_currency.id_user', '=', Auth::user()->id)
        ->select([
            'brokers.name AS brokerName',
            'currency_symbols.id AS currencyId',
            'user_currency.id AS userCurrencyId',
            'currency_symbols.symbol AS currencySymbol'
        ])->get();

        return view('dashboard.index', compact('userCurrencySymbols'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) {
            return redirect(route('dashboard.index'));
        }

        $currencyId = (int)$request->currencyId;
        $idExists = CurrencySymbol::where('id', $currencyId)->first();

        $coinAlreadyAdded = UserCurrency::where('id_currency_symbol', $currencyId)->first();

        if (!$idExists) {
            return Response()->json(['error' => true, 'message' => 'Moeda inexistente']);
        }

        if ($coinAlreadyAdded) {
            return Response()->json(['error' => true, 'message' => 'Essa moeda já foi adicionada']);
        }

        $currencyLimit = UserCurrency::where('id_user', Auth::user()->id)->get()->count();
        if ($currencyLimit == 5) {
            return Response()->json(['error' => true, 'message' => 'Limite de moedas atingido, Premium aqui']);
        }

        $addUserCurrency = [
            'id_user' => auth()->user()->id,
            'id_currency_symbol' => $currencyId
        ];


        UserCurrency::create($addUserCurrency);

        $data = [
            'success' => true,
            'message' => 'adicionado com sucesso'
        ];

        return Response()->json($data);
    }

    public function show($broker, $symbol)
    {
        $symbol = mb_strtoupper($symbol);
        $broker = mb_strtolower($broker);
        $offset = 0;

        $history = $this->selectHistoryCurrency($broker, $symbol, $offset);

        if (!$history) {
            return view('dashboard.coin-not-found');
        }

        return view('dashboard.history-currency', compact('history'));
    }

    public function loadMore(Request $request, $broker, $symbol, $offset = 0)
    {
        if (!$request->ajax()) {
            return redirect(route('dashboard.index'));
        }

        $history = $this->selectHistoryCurrency($broker, $symbol, $offset);
        $html = "";
        if (isset($history->dataJson)) {
            foreach ($history->dataJson as $item) {
                $html .= view('dashboard.fragments.history-grid', compact(['history', 'item']))->render();
            }
        }

        $html = $html == "" ? ['error' => true] : $html;
        return Response()->json($html);
    }

    private function selectHistoryCurrency($broker, $symbol, $offset = 0)
    {
        $query = DB::table('user_currency')
        ->join('currency_symbols', 'currency_symbols.id', '=', 'user_currency.id_currency_symbol')
        ->join('brokers', 'brokers.id', '=', 'currency_symbols.id_broker')
        ->join('currency_history', 'brokers.id', '=', 'currency_history.id_broker')
        ->where('user_currency.id_user', Auth::user()->id)
        ->where('currency_symbols.symbol', $symbol)
        ->where('brokers.name', $broker)
        ->offset($offset)
        ->limit(25)
        ->get();

        if (!isset($query[0])) {
            return;
        }

        $history = [
            'offset' => $offset,
            'brokerId' =>  $query[0]->id_broker,
            'brokerName' => $query[0]->name,
            'symbol' => $query[0]->symbol,
            'symbolId' => $query[0]->id_currency_symbol,
            'dataJson' => []
        ];

        $dataCoin = [];
        foreach ($query as $currency) {
            $json = json_decode($currency->data_json);
            foreach ($json as $obj) {
                if ($obj->symbol == mb_strtoupper($symbol)) {
                    $dateTime = $obj->created_at->date;
                    $now = new \dateTime($dateTime);
                    $dateTime = $now->format('Y/m/d - H:i');
                    $obj->dateTime = $dateTime;
                    $dataCoin[] = $obj;
                }
            }
        }

        $history['dataJson'] = $dataCoin;
        $history = (object)$history;

        return $history;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
