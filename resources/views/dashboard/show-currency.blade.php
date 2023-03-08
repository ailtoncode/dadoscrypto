@extends('site.layout')
@section('title', 'Show')

@section('content')
@php
// dd($currencyUserSelect[0]->brokerName)
@endphp

<h3 class="fs-6">{{Str::ucfirst($currencyUserSelect[0]->brokerName)}} {{$currencyUserSelect[0]->symbol}}</h3>

@endsection
