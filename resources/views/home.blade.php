@extends('layouts.app')
@push('scripts')
    <script src="{{ mix('/js/feedback.js') }}"></script>
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ mix('/css/home.css') }}">
@endpush
@section('header')
    @parent
    @section('nav')
        <a href="http:/khpk.ru">Основной сайт</a>
        <a href="#info" class="anchor">Прием</a>
        <a href="/rating">Личный кабинет</a>
        <a href="#contacts" class="anchor">Контакты</a>
    @endsection
    <div class="switch_block">
        <a onclick="switch_click('/?institution=1', ['#banner', '#specialties', '#info'], '#loader')" class="switch active disabled">Колледж</a>
        <a onclick="switch_click('/?institution=2', ['#banner', '#specialties', '#info'], '#loader')" class="switch">Филиал</a>
    </div>
    <a href="/request" class="button">Подать заявку</a>
@endsection
@section('content')
<section id="banner">
    <div class="block_form">
        <h1 class="gradient">
            @if(request('institution', 1) == 1) 
                Поступай в ХПК!
            @else
                Поступай<br>в филиал ХПК!
            @endif
        </h1>
        <form action="/request" method="post">
            @csrf
            <div class="block_input">
                <input type="text" placeholder="Ваше имя" name="name" maxlength="255">
                <input type="text" placeholder="Ваша фамилия" name="surname" maxlength="255">
                <input type="text" placeholder="Email" name="mail" maxlength="255">
                <input type="submit" value="Продолжить">
            </div>
        </form>
    </div>
    <div class="illustration"></div>
</section>
<section id="specialties">
    <div class="illustration"></div>
    <div class="block_form">
        <h1>Знания,<br>которые работают</h1>
        @include('ajax.home.specialties')
    </div>
</section>
<section id="info">
    <h1 class="accent">Информация о приеме {{ date('Y') }}</h1>
    <div class="block_info">
        <div class="block ajax_info">
            <div class="title">
                <span class="large"><b>Сроки приема</b></span>
                <div class="switch_block">
                    <a onclick="switch_click('/?format=1&institution={{ request('institution', 1) }}', ['.ajax_info .date_time_block', '.ajax_info .status_block'], '.ajax_info')" class="switch active disabled">Очно</a>
                    <a onclick="switch_click('/?format=2&institution={{ request('institution', 1) }}', ['.ajax_info .date_time_block', '.ajax_info .status_block'], '.ajax_info')" class="switch">Заочно</a>
                </div>
            </div>
            <div class="date_time_block">
                <div class="block_circle from">
                    <span class="text">{{ $deadline->start }}</span>
                    <span class="sign">{{ $deadline->start_sign }}</span>
                </div>
                <div class="jump">
                    <div class="circle"></div>
                    <div class="circle"></div>
                    <div class="circle"></div>
                </div>
                <div class="block_circle">
                    <span class="text">{{ $deadline->ending }}</span>
                    <span class="sign">{{ $deadline->ending_sign }}</span>
                </div>
            </div>
            <div class="status_block">
                @if ($deadline->start <= $now && $deadline->ending >= $now)
                    <span>Статус приема</span>
                    <span class="status"><b>начат</b></span>
                @elseif ($deadline->start > $now)
                    <span>Статус приема</span>
                    <span class="status"><b>не начат</b></span>
                @elseif ($deadline->ending < $now) 
                    <span>Статус приема</span>
                    <span class="status"><b>завершился</b></span>
                @else
                    <span>Сроки не установлены</span>
                @endif
            </div>
        </div>
        <div class="block documents">
            <div class="title">
                <span class="large"><b>Пакет необходимых документов</b></span>
                <a href="/request" class="button">У меня все есть</a>
            </div>
            <div class="list_block">
                <div class="list">
                    @svg('/app/public/img/icons/user.svg', 'icon')
                    <span class="middle">Документ, удостоверяющий личность</span>
                </div>
                <div class="list">
                    @svg('/app/public/img/icons/star.svg', 'icon')
                    <span class="middle">Документ об образовании или квалификации</span>
                </div>
                <div class="list">
                    @svg('/app/public/img/icons/photo.svg', 'icon')
                    <span class="middle">4-е фотографии размером 3x4</span>
                </div>
                <div class="list">
                    @svg('/app/public/img/icons/heart.svg', 'icon')
                    <span class="middle">Медицинская справка формы 086у</span>
                </div>
                <div class="list">
                    @svg('/app/public/img/icons/document-add.svg', 'icon')
                    <span class="middle">Копия прививочной карты или сертификата о прививках</span>
                </div>
            </div>
        </div>
    </div>
    <div class="block_info">
        <div class="block request ajax_request">
            <div class="title">
                <span class="large"><b>Как проходит подача заявления</b></span>
                <div class="switch_block">
                    <a onclick="switch_click('/?req=1', ['.ajax_request .list_block'], '.ajax_request')" class="switch active disabled">Онлайн</a>
                    <a onclick="switch_click('/?req=2', ['.ajax_request .list_block'], '.ajax_request')" class="switch">Офлайн</a>
                </div>
            </div>
            <div class="list_block">
                @if (request('req', 1) == 1)
                <div class="list">
                    @svg('/app/public/img/icons/document.svg', 'icon')
                    <div class="text">
                        <div class="circle">1</div>
                        <span class="middle">Подготовка и сканирование пакета документов</span>
                    </div>
                </div>
                <div class="list">
                    @svg('/app/public/img/icons/cloud-upload.svg', 'icon')
                    <div class="text">
                        <div class="circle">2</div>
                        <span class="middle">Подача <a href="/request" class="underlined">онлайн заявки</a></span>
                    </div>
                </div>
                <div class="list">
                    @svg('/app/public/img/icons/ok-circle.svg', 'icon')
                    <div class="text">
                        <div class="circle">3</div>
                        <span class="middle">Подтверждение заявки приемной комиссией</span>
                    </div>
                </div>
                <div class="list">
                    @svg('/app/public/img/icons/stats.svg', 'icon')
                    <div class="text">
                        <div class="circle">4</div>
                        <span class="middle">Отслеживание рейтинга в личном кабинете</span>
                    </div>
                </div>
                @else
                <div class="list">
                    @svg('/app/public/img/icons/document.svg', 'icon')
                    <div class="text">
                        <div class="circle">1</div>
                        <span class="middle">Подготовка пакета документов</span>
                    </div>
                </div>
                <div class="list">
                    @svg('/app/public/img/icons/location.svg', 'icon')
                    <div class="text">
                        <div class="circle">2</div>
                        <span class="middle">Посещение лично приемной комиссии</span>
                    </div>
                </div>
                <div class="list">
                    @svg('/app/public/img/icons/lock.svg', 'icon')
                    <div class="text">
                        <div class="circle">3</div>
                        <span class="middle">Получение доступа к личному кабинету</span>
                    </div>
                </div>
                <div class="list">
                    @svg('/app/public/img/icons/stats.svg', 'icon')
                    <div class="text">
                        <div class="circle">4</div>
                        <span class="middle">Отслеживание рейтинга в личном кабинете</span>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="block commission">
            <div class="title">
                <span class="large"><b>Режим работы<br>приемной комиссии</b></span>
                <span class="status"><b>{{ $commission->status }}</b></span>
            </div>
            <div class="date_time_block">
                <div class="block_circle from">
                    <span class="text">{{ $commission->start_day }}</span>
                    <span class="sign">{{ $commission->start_day_sign }}</span>
                </div>
                <div class="jump">
                    <div class="circle"></div>
                    <div class="circle"></div>
                    <div class="circle"></div>
                </div>
                <div class="block_circle">
                    <span class="text">{{ $commission->ending_day }}</span>
                    <span class="sign">{{ $commission->ending_day_sign }}</span>
                </div>
            </div>
            <div class="date_time_block">
                <div class="block_circle from">
                    <span class="text">{{ $commission->start_time->format('H') }}</span>
                    <span class="sign">{{ $commission->start_time->format('i') }}</span>
                </div>
                <div class="jump">
                    <div class="circle"></div>
                    <div class="circle"></div>
                    <div class="circle"></div>
                </div>
                <div class="block_circle">
                    <span class="text">{{ $commission->ending_time->format('H') }}</span>
                    <span class="sign">{{ $commission->ending_time->format('i') }}</span>
                </div>
            </div>
            <div class="status_block">
                @if($commission->status_block)
                    {{ $commission->status_block }}
                @else 
                    <span>Обед с {{ $commission->start_dinner->format('H:i') }} до {{ $commission->ending_dinner->format('H:i') }}</span>
                @endif
            </div>
        </div>
    </div>
</section>
<section id="contacts">
    <h1>Контактная информация</h1>
    <div class="block_contacts">
        <div class="block">
            <div class="list">
                <span class="large accent"><b>Адрес</b></span>
                <span class="middle">Республика Хакасия, г. Абакан, ул. Пушкина 30</span>
            </div>
            <div class="list">
                <span class="large accent"><b>Телефон</b></span>
                <span class="middle"><a href="tel:+73902343557">+7 390 234 - 35 - 57</a></span>
            </div>
            <div class="list">
                <span class="large accent"><b>Электронная почта</b></span>
                <span class="middle"><a href="mailto:kollege@khpk.ru">kollege@khpk.ru</a></span>
            </div>
        </div>
        <div class="block map">
            <iframe src="https://yandex.ru/map-widget/v1/-/CCU4YLq1TA" frameborder="0" allowfullscreen="true" style="position:relative;"></iframe>
        </div>
    </div>
</section>
<section id="feedback">
    <h1>Остались вопросы?</h1>
    <form method="post">
        <h3>Напишите сообщение</h3>
        @csrf
        <div class="block_input">
            <input type="text" placeholder="Ваше имя" name="name" maxlength="255" class="input">
            <input type="text" placeholder="Номер телефона" name="phone" maxlength="255" class="input">
            <input type="text" placeholder="Email" name="mail" maxlength="255" class="input">
            <textarea type="text" placeholder="Ваше сообщение" name="message" class="input"></textarea>
            <input type="submit" value="Отправить">
        </div>
    </form>
    @include('layouts.message', [
        'title' => 'Форма обратной связи'
    ])
</section>
<div id="loader"></div>
@endsection