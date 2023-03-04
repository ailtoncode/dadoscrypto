@extends('site.layout')
@section('title', 'Login')

@section('content')
    @if($message = Session::get('erro'))
        {{--dd($errors->all())--}}
        {{$message}}

        @endif
    <form action="{{route('login.auth')}}" method="POST">
    @csrf
    <input type="text" name="email">
    <input type="password" name="password" value="12345678">
    <button type="submit">Salvar</button>
    </form>
@endsection
