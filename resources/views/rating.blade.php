@extends('layouts.app')
@section('title', 'Личный кабинет')
@section('header')
    @parent
    <a href="/logout/enrolle">Выйти</a>
@endsection
@section('content')
    <section>
        {{ $enrolle->full_name }}
        <h1>Ваши заявки</h1>
        @foreach ($requests as $request)
            {{ $request->speciality->code }}
            {{ $request->speciality->name }}
            {{ $request->speciality->qualification }}
            {{ $request->status->name }}
            <a href="/rating/request/delete/{{ $request->id }}">Удалить</a>
        @endforeach
    </section>
@endsection