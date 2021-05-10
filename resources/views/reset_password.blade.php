@extends('layouts.app')
@section('title', 'Сброс пароля')
@section('header')
    @parent
    @section('nav')
        <a href="http:/khpk.ru">Основной сайт</a>
        <a href="/#info">Прием</a>
        <a href="/#contacts">Контакты</a>
    @endsection
@endsection
@section('content')
<section class="flex-center">
    <div class="block_form">
    <h1>Сброс пароля</h1>
    <form method="post" class="form_block">
        @csrf
        <div class="block_input">
            <input type="password" placeholder="Новый пароль" name="password">
            <input type="password" placeholder="Подтверждение пароля" name="password_apply">
            <input type="submit" value="Продолжить">
        </div>
    </form>
    </div>
    @if (isset($message)) 
    @include('layouts.message', [
        'title' => 'Сброс пароля',
        'message' => $message
    ])
    @else
    @include('layouts.message', [
        'title' => 'Сброс пароля'
    ])
    @endif
</section>
@endsection