@extends('layouts.app')
@section('title', 'Личный кабинет')
@push('styles')
    <link rel="stylesheet" href="{{ mix('/css/rating.css') }}">
@endpush
@section('header')
    @parent
    @section('content_header')
    <div class="user">
        @svg('/app/public/img/icons/user.svg', 'icon')
        <span class="middle"><b>{{ $enrolle->full_name }}</b></span>
    </div>
    @endsection
    @section('nav')
    <a href="/logout/enrolle" class="button">Выйти</a>
    @endsection
@endsection
@section('content')
    <section id="rating">
        @if ($requests === Array())
        <h1>Ваши заявки</h1>
        <a class="button">Новая заявка</a>
        @foreach ($requests as $request)
            {{ $request->speciality->code }}
            {{ $request->speciality->name }}
            {{ $request->speciality->qualification }}
            {{ $request->status->name }}
            <a href="/rating/request/delete/{{ $request->id }}">Удалить</a>
        @endforeach
        @else
        <h1>У вас нет заявок</h1>
        <a href="/request" class="button">Подать заявку</a>
        @endif
    </section>
@endsection