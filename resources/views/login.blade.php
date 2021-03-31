@extends('layouts.app')
@section('title', 'Вход')
@section('content')
<section>
    <form method="post" action="/login/enrolle">
        @csrf
        <input type="text" placeholder="Логин или email" name="login">
        <input type="password" placeholder="Пароль" name="password">
        <input type="submit" value="Войти">
    </form>
    <a href="/login/enrolle/reset/password">Забыли пароль?</a>
    @if ($errors->all())
        <div class="message">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
</section>
<section>
    <h1>Еще не регистрировались?</h1>
    <form action="/request" method="post">
        @csrf
        <input type="text" placeholder="Ваше имя" name="name">
        <input type="text" placeholder="Ваша фамилия" name="surname">
        <input type="submit" value="Продолжить">
    </form>
</section>
@endsection