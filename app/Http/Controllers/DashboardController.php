<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function searchTokens(Request $request)
    {
        $response = [
            'success' => true,
            'data' => 'dados de resposta'
        ];

        return json_encode($response);
    }
}
