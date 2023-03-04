<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function searchTokens(Request $request)
    {
        if (!$request->ajax()) {
            return redirect(route('dashboard.index'));
        }

        $tokens = DB::table('currency_symbols')
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
            'searchResult' => view('dashboard.fragments.search-tokens', compact('tokens'))->render()
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
