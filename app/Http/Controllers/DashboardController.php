<?php

namespace App\Http\Controllers;

use App\Models\CurrencySymbol;
use App\Models\UserCurrency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function searchTokens(Request $request)
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
        return view('dashboard.index');
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

        $coinAlreadyAdded = UserCurrency::where('id_currency_symbols', $currencyId)->first();

        if (!$idExists) {
            return Response()->json(['error' => 'non-existent id']);
        }

        if ($coinAlreadyAdded) {
            return Response()->json(['error' => true, 'message' => 'Essa moeda já foi adicionada']);
        }

        $addUserCurrency = [
            'id_user' => auth()->user()->id,
            'id_currency_symbols' => $currencyId
        ];

        UserCurrency::create($addUserCurrency);

        $data = [
            'success' => true,
            'message' => 'adicionado com sucesso'
        ];

        return Response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
