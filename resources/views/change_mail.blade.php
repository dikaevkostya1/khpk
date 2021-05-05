@extends('layouts.app')
@section('title', 'Изменение почты')
@section('header')
    <a href="{{ url()->previous() }}">Назад</a>
    @parent
@endsection
@section('content')
<section id="request">
    <form method="post" action="/request/verify/change">
        @csrf
        <div class="block_input">
            <input type="text" placeholder="Новый email" name="mail">
            <input type="submit" value="Продолжить">
        </div>
    </form>
    @if ($errors->all())
        <div id="message" style="display: block;">
            <h3>Сообщение</h3>
            <div class="message">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
            </div>
            <a onclick="close_message()">Закрыть</a>
        </div>
    @endif
</section>
@endsection