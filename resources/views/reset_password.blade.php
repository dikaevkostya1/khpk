@extends('layouts.app')
@section('title', 'Сброс пароля')
@section('content')
<section id="request">
    <form method="post">
        @csrf
        <input type="password" placeholder="Новый пароль" name="password">
        <input type="password" placeholder="Подтверждение пароля">
        <input type="submit" value="Продолжить">
    </form>
</section>
@endsection