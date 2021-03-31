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
        <input type="text" placeholder="Новый email" name="mail">
        <input type="submit" value="Продолжить">
    </form>
    @if ($errors->all())
        <div class="message">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
</section>
@endsection