@extends('layouts.admin.app')
@section('title', 'Вход')
@section('content')
<section>
    <form method="post" action="/login/admin" class="form_block">
        @csrf
        <input type="text" placeholder="Логин" name="login">
        <input type="password" placeholder="Пароль" name="password">
        <input type="submit" value="Войти">
    </form>
    @if ($errors->all())
        <div id="message">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
</section>
@endsection