<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function searchTokens(Request $request)
    {
        $tokens = DB::table('currency_symbols')
        ->join('brokers', 'currency_symbols.id_broker', '=', 'brokers.id')
        ->where('currency_symbols.symbol', 'LIKE', '%' . $request->term . '%')->limit(10)->get();
        $response = [
            'success' => true,
            'tokens' => $tokens,
            'term' => $request->term,
            'testeView' => view('admin.search-tokens')
        ];

        return Response()->json([
            'searchResult' => view('admin.search-tokens', compact('tokens'))->render()
        ]);
        // return json_encode(view('admin.search-tokens'));
    }
}
