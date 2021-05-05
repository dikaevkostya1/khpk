<section id="request">
    <form method="post">
        @csrf
        <div class="block_input">
        <h3>Основные данные</h3>
        <input type="text" placeholder="Имя" value="{{ $name }}" name="name">
        <input type="text" placeholder="Фамилия" value="{{ $surname }}" name="surname">
        <input type="text" placeholder="Отчество (если есть)" name="middlename">
        <input type="text" placeholder="Дата рождения"  onfocus="(this.type='date')" onblur="(this.type='text')" name="date_born">
        <input type="text" placeholder="Место рождения" name="place_born">
        <input type="text" placeholder="Адрес регистрации" name="address_registration">
        <input type="text" placeholder="Адрес проживания" name="address_actual">
        </div>
        <div class="block_input">
        <h3>Паспортные данные</h3>
        <input type="text" placeholder="Серия и номер" name="passport">
        <input type="text" placeholder="Дата выдачи"  onfocus="(this.type='date')" onblur="(this.type='text')" name="passport_date">
        <input type="text" placeholder="Кем выдан" name="passport_issued">
    </div>
    <div class="block_input">
        <h3>Контактные данные</h3>
        <input type="text" placeholder="Номер телефона" name="phone">
        <input type="mail" placeholder="Email" value="{{ $mail }}" name="mail">
    </div>
    <div class="block_input">
        <h3>Образование</h3>
        <input type="text" placeholder="Наименование учреждения" name="education_name">
        <input type="text" placeholder="Год окончания" name="education_ending">
        <select name="education_id">
            @foreach ($educations as $education)
                <option value="{{ $education->id }}">{{ $education->name }}</option>
            @endforeach
        </select>
        <input type="text" placeholder="Серия и номер" name="education">
    </div>
    <div class="block_input">
        <h3>Данные для входа</h3>
        <input type="text" placeholder="Логин" name="login">
        <input type="password" placeholder="Пароль" name="password">
        <input type="password" placeholder="Подтверждение пароля">
    </div>
        <input type="submit" value="Продолжить">
    </form>
    @include('layouts.message', [
        'title' => 'Ошибка формы'
    ])
</section>
<script src="{{ mix('/js/request.js') }}"></script>