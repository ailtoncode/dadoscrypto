@extends('site.layout')
@section('title', 'Cadastro')

@section('content')
    @if($errors->any())
        {{--dd($errors->all())--}}
    @endif
    <form action="{{route('users.store')}}" method="POST">
    @csrf
    <input type="text" name="first_name">
    <input type="text" name="last_name">
    <input type="text" name="email">
    <input type="password" name="password" value="12345678">
    <button type="submit">Salvar</button>
    </form>
@endsection