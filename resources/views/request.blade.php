@extends('layouts.app')
@push('scripts')
    <script src="/js/request.js"></script>
@endpush
@section('content')
<section id="request">
    <form method="post">
        @csrf
        <input type="text" placeholder="Ваше Имя" value="{{ $name }}">
        <input type="text" placeholder="Ваша Фамилия" value="{{ $surname }}">
        <input type="text" placeholder="Ваше Отчество">
        <input type="text" placeholder="Дата рождения">
        <input type="text" placeholder="Адрес регистрации">
        <input type="text" placeholder="Адрес проживания">
        <input type="text" placeholder="Серия">
        <input type="text" placeholder="№">
        <input type="text" placeholder="Дата выдачи">
        <input type="text" placeholder="Кем выдан">
        <input type="text" placeholder="Номер телефона">
        <input type="text" placeholder="Год окончания">
        <input type="text" placeholder="Логин">
        <input type="text" placeholder="E-mail">
        <input type="password" placeholder="Пароль">
        <input type="password" placeholder="Подтверждение пароля">
        <input type="submit" value="Продолжить">
    </form>
</section>
@endsection