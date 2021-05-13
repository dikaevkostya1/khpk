@extends('layouts.admin.app')
@section('title', 'Вход')
@section('content')
<section id="login">
    <form method="post" action="/login/admin" class="form_block">
        @csrf
        <div class="block_input">
            <input type="text" placeholder="Логин" name="login">
            <input type="password" placeholder="Пароль" name="password">
            <input type="submit" value="Войти">
        </div>
    </form>
    @include('layouts.message', [
        'title' => 'Ошибка'
    ])
</section>
@endsection