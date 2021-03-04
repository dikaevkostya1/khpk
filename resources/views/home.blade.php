@extends('layouts.app')
@section('content')
<section>
    <h1>Поступай в ХПК!</h1>
    <form action="/request" method="post">
        @csrf
        <input type="text" placeholder="Ваше Имя" name="name">
        <input type="text" placeholder="Ваша Фамилия" name="surname">
        <input type="submit" value="Продолжить">
    </form>
</section>
<section>
    <h1>Знания, которые работают</h1>
    @include('ajax.home.specialties')
</section>
@endsection