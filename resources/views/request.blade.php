@extends('layouts.app')
@section('content')
<section>
    <form action="/request/enrolle" method="post">
        @csrf
        <input type="text" placeholder="Ваше Имя" value="{{ $name }}">
        <input type="text" placeholder="Ваша Фамилия" value="{{ $surname }}">
        <input type="text" placeholder="Ваше Отчество">
        <input type="text" placeholder="Адресс проживания">
        <input type="text" placeholder="Номер телефона">
        <input type="text" placeholder="Дата рождения">
    </form>
</section>
@endsection