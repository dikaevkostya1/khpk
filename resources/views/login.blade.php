@extends('layouts.app')
@section('title', 'Личный кабинет')
@section('content')
<section id="request">
    <form method="post" action="/login/enrolle">
        @csrf
        <input type="text" placeholder="Логин или e-mail" name="login">
        <input type="password" placeholder="Пароль" name="password">
        <input type="submit" value="Продолжить">
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
@endsection