@extends('layouts.app')
@section('title', 'Личный кабинет')
@push('styles')
    <link rel="stylesheet" href="{{ mix('/css/rating.css') }}">
@endpush
@section('header')
    @parent
    @section('nav')
        <a href="http:/khpk.ru">Основной сайт</a>
        <a href="/#info">Прием</a>
        <a href="/#contacts">Контакты</a>
    @endsection
    <div class="user">
        @svg('/app/public/img/icons/user.svg', 'icon')
        <span class="middle"><b>{{ $enrolle->full_name }}</b></span>
        <a href="/logout/enrolle" class="button_small">Выйти</a>
    </div>
@endsection
@section('content')
    <section id="rating">
        <div class="block_column">
        <div class="title_block">
            
            <div class="title">
                <h1 class="gradient">Ваши заявки</h1>
                <div class="count"><b>{{ count($requests) }}</b></div>
            </div>
            <div class="switch_block">
                <a onclick="switch_click('/rating?institution=1', ['#rating'], '#loader')" class="switch @if(request('institution', 1) == 1) active disabled @endif">Колледж</a>
                <a onclick="switch_click('/rating?institution=2', ['#rating'], '#loader')" class="switch @if(request('institution', 1) == 2) active disabled @endif">Филиал</a>
            </div>
            @if (count($requests) > 0)
            <a href="/request" class="button">Новая заявка</a>
            @else
            <a href="/request" class="button">Подать заявку</a>
            @endif   
        </div>
        @if (count($requests) > 0)
        @foreach ($requests as $request)
        <div class="request_block">
            <div class="title">
                <div class="text">
                    <span class="code">{{ $request->speciality->speciality->code }}</span>
                    <span class="name">{{ $request->speciality->qualification }}</span>
                </div>
                <div class="chevron"></div>
            </div>
        </div>
        @endforeach
        @else
        <h1>Нет заявок</h1>
        @endif
        </div>
    </section>
@endsection