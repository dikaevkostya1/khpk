@extends('layouts.app')
@push('scripts')
    <script src="/js/feedback.js"></script>
@endpush
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
<section id="feedback">
    <h1>Остались вопросы?</h1>
    <form method="post">
        @csrf
        <input type="text" placeholder="Ваше Имя" name="name">
        <input type="text" placeholder="Номер телефона" name="phone">
        <input type="text" placeholder="E-mail" name="mail">
        <textarea type="text" placeholder="Ваше сообщение" name="message"></textarea>
        <input type="submit" value="Отправить">
    </form>
    <div class="message"></div>
</section>
@endsection