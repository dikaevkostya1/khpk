@extends('layouts.app')
@section('title', 'Сброс пароля')
@section('header')
    <a href="{{ url()->previous() }}">Назад</a>
    @parent
@endsection
@section('content')
<section id="request">
    <form method="post">
        @csrf
        <input type="text" placeholder="E-mail" name="mail">
        <input type="submit" value="Продолжить">
    </form>
    <div class="message">{{ $message }}</div>
</section>
@endsection