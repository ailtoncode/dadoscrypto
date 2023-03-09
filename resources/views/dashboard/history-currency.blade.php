@extends('site.layout')
@section('title', 'Show')

@section('content')
@php
// dd($currencyData)
@endphp

<h3 class="fs-6">{{Str::ucfirst($currencyData->brokerName)}} {{$currencyData->symbol}}</h3>
<div style="font-size: 14px">
    <table>
        <thead>
            <tr class="text-center border-bottom border-2" style="background-color: #f5f4e6">
                <th scope="col">Data/Hora</th>
                <th scope="col">Preço</th>
                <th scope="col">Variação</th>
                <th scope="col">Variação (%)</th>
                <th scope="col">Maximo</th>
                <th scope="col">Minimo</th>
                <th scope="col">Volume</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($currencyData->dataJson as $item)
            <tr class="border-bottom border-2 text-center">
                <td class="px-2">{{$item->created_at->date}}</td>
                <td class="px-2">{{$item->price}}</td>
                <td class="px-2">{{$item->variation}}</td>
                <td class="px-2">{{$item->variation_percent}}</td>
                <td class="px-2">{{$item->maximum}}</td>
                <td class="px-2">{{$item->minimum}}</td>
                <td class="px-2">{{$item->volume}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="row" style="background-color: #ebebc5">
        <div class="col border-bottom"><b>Preço</b></div>
        <div class="col border-bottom"><b>Variação</b></div>
        <div class="col border-bottom"><b>Variação</b></div>
    </div>
    <div class="row" id="showCollapse" role="button">
        <div class="col border-bottom" style="background-color: #f5f4e6"><span>0.0000024587546987</span></div>
        <div class="col border-bottom" style="background-color: #f5f4e6"><span>0.0000024587546987</span></div>
        <div class="col border-bottom" style="background-color: #f5f4e6"><span>0.0000024587546987</span></div>
        <div class="collapse p-0 m-0 border-bottom" id="collapseExample">
            <div class="col px-4 show-currency-grid"><span class="fw-semibold">Maximo:</span> <span>0.0000024587546987</span></div>
            <div class="col px-4 show-currency-grid"><span class="fw-semibold">Minimo:</span> <span>0.0000024587546987</span></div>
            <div class="col px-4 show-currency-grid"><span class="fw-semibold">Volume:</span> <span>0.0000024587546987</span></div>
            <div class="col px-4 show-currency-grid"><span class="fw-semibold">Data/Hora:</span> 20/03/2023 08:36</div>
        </div>
    </div>
    <div class="row" id="showCollapse" role="button">
        <div class="col border-bottom" style="background-color: #f5f4e6"><span>0.0000024587546987</span></div>
        <div class="col border-bottom" style="background-color: #f5f4e6"><span>0.0000024587546987</span></div>
        <div class="col border-bottom" style="background-color: #f5f4e6"><span>0.0000024587546987</span></div>
        <div class="collapse p-0 m-0 border-bottom" id="collapseExample">
            <div class="col px-4 show-currency-grid"><span class="fw-semibold">Maximo:</span> <span>0.0000024587546987</span></div>
            <div class="col px-4 show-currency-grid"><span class="fw-semibold">Minimo:</span> <span>0.0000024587546987</span></div>
            <div class="col px-4 show-currency-grid"><span class="fw-semibold">Volume:</span> <span>0.0000024587546987</span></div>
            <div class="col px-4 show-currency-grid"><span class="fw-semibold">Data/Hora:</span> 20/03/2023 08:36</div>
        </div>
    </div> --}}
</div>
@endsection

@section('script')
<script>
    $(function(){
        $("#showCollapse").click(function(){
            $('#collapseExample').collapse('show')
        })
    });
</script>
@endsection
