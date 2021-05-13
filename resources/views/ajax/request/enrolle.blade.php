@section('header')
    @parent
    @section('nav')
        <a href="http:/khpk.ru">Основной сайт</a>
        <a href="/#info">Прием</a>
        <a href="/#contacts">Контакты</a>
    @endsection
    @section('content_header')
    @if (count($deadline_regis) > 0)
    <div class="request_stage">
        <div class="circle active">1</div>
        <div class="line @if($request_stage == 1) active @elseif($request_stage > 1) full_active @endif"></div>
        <div class="circle @if($request_stage >= 2) active @endif">2</div>
        <div class="line @if($request_stage == 2) active @elseif($request_stage > 2) full_active @endif"></div>
        <div class="circle @if($request_stage == 3) active @endif">3</div>
    </div>
    @endif
    @endsection
@endsection
<section id="request">
    <form method="post" class="block_column">
        @csrf
        <div class="title_block">
            @if (count($deadline_regis) > 0)
            <div class="title">
                <div class="stage"><b>{{ $request_stage }} этап</b></div>
                <h1 class="gradient">Регистрация</h1>
            </div>
            <input type="submit" value="Продолжить" disabled>
            @else
            <h1>Прием еще не начался</h1>
            <a href="/" class="button">На главную</a>
            @endif
        </div>
        @if (count($deadline_regis) > 0)
        <div class="block_request">
            <div class="form_block">
                <span class="title">Основные данные</span>
                <div class="block_input">
                    <input type="text" placeholder="Имя" value="{{ $name }}" name="name" maxlength="255" class="input">
                    <input type="text" placeholder="Фамилия" value="{{ $surname }}" name="surname" maxlength="255" class="input">
                    <input type="text" placeholder="Отчество (если есть)" name="middlename" maxlength="255" class="input">
                    <input type="text" placeholder="Дата рождения" name="date_born" class="input">
                    <input type="text" placeholder="Место рождения" name="place_born" maxlength="255" class="input">
                    <input type="text" placeholder="Адрес регистрации" name="address_registration" maxlength="255" class="input">
                    <input type="text" placeholder="Адрес проживания" name="address_actual" maxlength="255" class="input">
                </div>
            </div>
            <div class="slip">
                <div class="form_block">
                    <span class="title">Образование</span>
                    <div class="block_input">
                        <input type="text" placeholder="Наименование учреждения" name="education_name" maxlength="255" class="input">
                        <input type="text" placeholder="Год окончания" name="education_ending" class="input">
                        <div id="education_id" class="select input">
                            <span class="text">Вид документа</span>
                            <div class="list_option" style="display: none;">
                                @foreach ($educations as $education)
                                    <div class="option" data-value="{{ $education->id }}">{{ $education->name }}</div>
                                @endforeach
                            </div>
                        </div>
                        <input type="text" placeholder="Серия и номер" name="education" class="input">
                    </div>
                </div>
                <div class="form_block">
                    <span class="title">Контактные данные</span>
                    <div class="block_input">
                        <input type="text" placeholder="Номер телефона" name="phone" class="input">
                        <input type="text" placeholder="Email" value="{{ $mail }}" name="mail" maxlength="255" class="input">
                    </div>
                </div>
            </div>
            <div class="slip">
                <div class="form_block">
                    <span class="title">Паспортные данные</span>
                    <div class="block_input">
                        <input type="text" placeholder="Серия и номер" name="passport" class="input">
                        <input type="text" placeholder="Дата выдачи" name="passport_date" class="input">
                        <input type="text" placeholder="Кем выдан" name="passport_issued" maxlength="255" class="input">
                    </div>
                </div>
                <div class="form_block">
                    <span class="title">Данные для входа</span>
                    <div class="block_input">
                        <input type="text" placeholder="Логин" name="login" maxlength="255" class="input">
                        <input type="password" placeholder="Пароль" name="password" maxlength="255" class="input">
                        <input type="password" placeholder="Подтверждение пароля" name="password_apply" maxlength="255" class="input">
                    </div>
                </div>
            </div>
        </div>
        <div id="consent" class="footnote">
            <div class="flex-center apply_block">
                @svg('/app/public/img/icons/ok-circle.svg', 'apply')
                <span>Загружено</span>
            </div>
            <a class="button button_download">Загрузить<input type="file" name="consent_data" accept="image/*" class="input"></a>
            <div class="text">
                <h3 class="title">Согласие на обработку персональных данных</h3>
                <span><a href="/download/request/consent.pdf" class="underlined download">Скачайте</a> и заполните форму, после отсканируйте или сфотографируйте и загрузите</span>
            </div>
        </div>       
        @endif
    </form>
</section>
<div id="loader"></div>
@include('layouts.message', [
    'title' => 'Ошибка формы'
])
<script src="{{ mix('/js/request.js') }}"></script>