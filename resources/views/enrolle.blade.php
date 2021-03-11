@extends('layouts.app')
@push('scripts')
    <script src="/js/enrolle.js"></script>
@endpush
@section('content')
<section id="request">
    <form method="post">
        @csrf
        <h3>Основные данные</h3>
        <input type="text" placeholder="Имя" value="{{ $name }}" name="name">
        <input type="text" placeholder="Фамилия" value="{{ $surname }}" name="surname">
        <input type="text" placeholder="Отчество" name="middlename">
        <input type="text" placeholder="Дата рождения" name="date_born">
        <input type="text" placeholder="Место рождения" name="place_born">
        <input type="text" placeholder="Адрес регистрации" name="address_registration">
        <input type="text" placeholder="Адрес проживания" name="address_actual">
        <h3>Паспортные данные</h3>
        <input type="text" placeholder="Серия" name="passport_series">
        <input type="text" placeholder="№" name="passport_number">
        <input type="text" placeholder="Дата выдачи" name="passport_date">
        <input type="text" placeholder="Кем выдан" name="passport_issued">
        <h3>Контактные данные</h3>
        <input type="text" placeholder="Номер телефона" name="phone">
        <input type="text" placeholder="E-mail" name="mail">
        <h3>Образование</h3>
        <input type="text" placeholder="Наименование учреждения" name="education_name">
        <input type="text" placeholder="Год окончания" name="education_ending">
        <select name="education">
            @foreach ($educations as $education)
                <option value="{{ $education->id }}">{{ $education->name }}</option>
            @endforeach
        </select>
        <input type="text" placeholder="Серия" name="education_series">
        <input type="text" placeholder="№" name="education_number">
        <h3>Данные для входа</h3>
        <input type="text" placeholder="Логин" name="login">
        <input type="password" placeholder="Пароль" name="password">
        <input type="password" placeholder="Подтверждение пароля">
        <input type="submit" value="Продолжить">
    </form>
    <div class="message"></div>
</section>
@endsection