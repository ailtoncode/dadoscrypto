@extends('site.layout')
@section('title', 'Home')
@section('content')
{{-- {{dd($userCurrencySymbols)}} --}}
<div class="mx-4 mt-3 mb-1" style="max-width: 450px">
    <h1 class="fs-5">Moedas</h1>
    @foreach ($userCurrencySymbols as $currency)
    @php $fontColor = $currency->brokerName == 'binance' ? 'rgb(199, 161, 11)' : 'rgb(77, 112, 229)' @endphp
        <div class="row border-bottom">
            <div class="col-2 col-md-2 col-sm-2 fs-6 fw-semibold"><a href="{{route('history.show', ['broker' => Str::lower($currency->brokerName), 'symbol' => Str::lower($currency->currencySymbol)])}}">{{Str::ucfirst($currency->brokerName)}}</a></div>
            <div class="col-auto">-</div>
            <div class="col fs-6"><a href="{{route('history.show', ['broker' => Str::lower($currency->brokerName), 'symbol' => Str::lower($currency->currencySymbol)])}}">{{Str::upper($currency->currencySymbol)}}</a></div>
            {{-- remover moeda é um recurso premium --}}
            <div class="col-auto fs-6"><i class="bi bi-star-fill"></i></div>
        </div>
    @endforeach
</div>
{{-- {{dd($userCurrencySymbols)}} --}}
@endsection
