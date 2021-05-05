@extends('layouts.app')
@section('header')
    @parent
    @section('nav')
        <a href="http:/khpk.ru">Основной сайт</a>
        <a href="">Прием</a>
        <a href="/rating">Личный кабинет</a>
        <a href="">Контакты</a>
    @endsection
    <a href="/request" class="button">Подать заявку</a>
@endsection
@section('content')
    <section id="error">
        @svg('/app/public/img/icons/sad.svg', 'img')
        <div class="block">
            <h1>Упс. Такой страницы не существует,<br>либо она была удалена</h1>
            <a href="/" class="button">На главную</a>
        </div>
    </section>
@endsection