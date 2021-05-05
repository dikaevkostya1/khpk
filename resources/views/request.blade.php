@extends('layouts.app')
@section('title', 'Подача заявки')
@push('styles')
    <link rel="stylesheet" href="{{ mix('/css/request.css') }}">
@endpush
@section('header')
    @parent
    @section('logo')
        @include('layouts.button_back')
        @parent
    @endsection
    @section('nav')
        <a href="http:/khpk.ru">Основной сайт</a>
        <a href="">Прием</a>
        <a href="">Контакты</a>
    @endsection
@endsection
@section('content')
    @switch($request_stage)
        @case(1)
            @include('ajax.request.enrolle')
            @break
        @case(2)
            @include('ajax.request.verified')
            @break
        @case(3)
            @include('ajax.request.request')
            @break
    @endswitch
@endsection