@extends('layouts.app')
@push('scripts')
    <script src="{{ mix('/js/feedback.js') }}"></script>
@endpush
@section('header')
    @parent
    @section('nav')
        <a href="http:/khpk.ru">Основной сайт</a>
        <a href="">Прием</a>
        <a href="/login">Личный кабинет</a>
        <a href="">Контакты</a>
    @endsection
    <a href="/request">Подать заявку</a>
@endsection
@section('content')
<section>
    <h1>Поступай в ХПК!</h1>
    <form action="/request" method="post">
        @csrf
        <input type="text" placeholder="Ваше имя" name="name">
        <input type="text" placeholder="Ваша фамилия" name="surname">
        <input type="text" placeholder="Email" name="mail">
        <input type="submit" value="Продолжить">
    </form>
</section>
<section>
    <h1>Знания, которые работают</h1>
    @include('ajax.home.specialties')
</section>
<section id="feedback">
    <h1>Остались вопросы?</h1>
    <form method="post">
        @csrf
        <input type="text" placeholder="Ваше имя" name="name" class="input">
        <input type="text" placeholder="Номер телефона" name="phone" class="input">
        <input type="text" placeholder="Email" name="mail" class="input">
        <textarea type="text" placeholder="Ваше сообщение" name="message" class="input"></textarea>
        <input type="submit" value="Отправить">
    </form>
    <div class="message"></div>
</section>
@endsection