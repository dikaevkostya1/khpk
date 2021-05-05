@extends('layouts.app')
@section('title', 'Сброс пароля')
@section('content')
<section id="request">
    <form method="post">
        @csrf
        <div class="block_input">
            <input type="password" placeholder="Новый пароль" name="password">
            <input type="password" placeholder="Подтверждение пароля">
            <input type="submit" value="Продолжить">
        </div>
    </form>
</section>
@endsection