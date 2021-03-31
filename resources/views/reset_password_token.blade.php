@extends('layouts.app')
@section('title', 'Сброс пароля')
@section('content')
<section id="request">
    <form method="post">
        @csrf
        <input type="text" placeholder="Email" name="mail">
        <input type="submit" value="Продолжить">
    </form>
    <div class="message">{{ $message ?? '' }}</div>
</section>
@endsection