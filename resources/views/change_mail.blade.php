@extends('layouts.app')
@section('title', 'Изменение почты')
@section('header')
    @parent
    @section('logo')
        @include('layouts.button_back', ['url' => '/request'])
        @parent
    @endsection
@endsection
@section('content')
<section class="flex-center">
    <div class="block_form">
    <h1>Изменение почты</h1>
    <form method="post" action="/request/verify/change" class="form_block">
        @csrf
        <div class="block_input">
            <input type="text" placeholder="Новый email" name="mail">
            <input type="submit" value="Продолжить">
        </div>
    </form>
    </div>
    @include('layouts.message', [
        'title' => 'Ошибка'
    ])
</section>
@endsection