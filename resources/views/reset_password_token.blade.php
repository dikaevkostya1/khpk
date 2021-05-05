@extends('layouts.app')
@section('title', 'Сброс пароля')
@section('content')
<section id="request" class="flex-center">
    <div class="block_form">
    <h1>Сброс пароля</h1>
    <form method="post">
        @csrf
        <div class="block_input">
            <input type="text" placeholder="Email" name="mail">
            <input type="submit" value="Продолжить">
        </div>
    </form>
    </div>
    <div id="message">{{ $message ?? '' }}</div>
</section>
@endsection