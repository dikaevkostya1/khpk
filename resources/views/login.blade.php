@extends('layouts.app')
@section('title', 'Вход')
@section('header')
    @parent
    @section('nav')
        <a href="http:/khpk.ru">Основной сайт</a>
        <a href="#info" class="anchor">Прием</a>
        <a href="#contacts" class="anchor">Контакты</a>
    @endsection
    <a href="/request" class="button">Подать заявку</a>
@endsection
@section('content')
<section id="login">
    <div class="block_form">
    <h1>Авторизация</h1>
    <form method="post" action="/login/enrolle" class="form_block">
        @csrf
        <div class="block_input">
            <input type="text" placeholder="Логин или email" name="login">
            <input type="password" placeholder="Пароль" name="password">
            <a href="/login/enrolle/reset/password">Забыли пароль?</a>
            <input type="submit" value="Войти">
        </div>
    </form>
    </div>
    <div class="block_form">
        <h1 class="gradient">У вас еще<br>нет аккаунта?</h1>
        <form action="/request" method="post" class="form_block">
            @csrf
            <div class="block_input">
                <input type="text" placeholder="Ваше имя" name="name">
                <input type="text" placeholder="Ваша фамилия" name="surname">
                <input type="submit" value="Продолжить">
            </div>
        </form>
    </div>
    @include('layouts.message', [
        'title' => 'Ошибка'
    ])
</section>
@endsection