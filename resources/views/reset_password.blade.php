@extends('layouts.app')
@section('title', 'Сброс пароля')
@section('content')
<section id="request">
    <form method="post">
        @csrf
        <input type="text" placeholder="Новый пароль" name="password">
        <input type="text" placeholder="Подтверждение пароля">
        <input type="submit" value="Продолжить">
    </form>
</section>
@endsection