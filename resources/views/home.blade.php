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
        @if(!Auth::check())
        <a href="/login">Личный кабинет</a>
        @endif
        <a href="#contacts" class="anchor">Контакты</a>
    @endsection
    <div class="switch_block">
        <a onclick="switch_click('/?institution=1', ['#banner', '#specialties', '#info', '#contacts', '#feedback'], '#loader')" class="switch @if(request('institution', 1) == 1) active disabled @endif">Колледж</a>
        <a onclick="switch_click('/?institution=2', ['#banner', '#specialties', '#info', '#contacts', '#feedback'], '#loader')" class="switch @if(request('institution', 1) == 2) active disabled @endif">Филиал</a>
    </div>
    @if(Auth::check())
    <a href="/rating" class="button">Личный кабинет</a>
    @else
    <a href="/request" class="button">Подать заявку</a>
    @endif
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
        <form action="/request" method="post" class="form_block">
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
<section id="specialties" class="specialties">
    <div class="illustration"></div>
    <div class="block_form">
        <h1>Знания,<br>которые работают</h1>
        <div class="block">
            <div class="switches">
                <div class="switch_block2">
                    <a onclick="switch_click('/?format=1&finansing={{ request('finansing', 1) }}&institution={{ request('institution', 1) }}', ['#specialties .block'], '#specialties .block')" class="switch @if(request('format', 1) == 1) active disabled @endif">Очное</a>
                    <a onclick="switch_click('/?format=2&finansing={{ request('finansing', 1) }}&institution={{ request('institution', 1) }}', ['#specialties .block'], '#specialties .block')" class="switch @if(request('format', 1) == 2) active disabled @endif">Заочное</a>
                </div>
                <div class="switch_block2">
                    <a onclick="switch_click('/?finansing=1&format={{ request('format', 1) }}&institution={{ request('institution', 1) }}', ['#specialties .block'], '#specialties .block')" class="switch @if(request('finansing', 1) == 1) active disabled @endif">Бюджет</a>
                    <a onclick="switch_click('/?finansing=2&format={{ request('format', 1) }}&institution={{ request('institution', 1) }}', ['#specialties .block'], '#specialties .block')" class="switch @if(request('finansing', 1) == 2) active disabled @endif">Платное</a>
                </div>
            </div>
            <div class="list">
                @foreach ($specialties as $specialty)
                <div class="specialty_qualifications">
                    <div class="specialty">
                        <span class="code">{{ $specialty->code }}</span>
                        <span class="name">{{ $specialty->name }}</span>
                        <div class="chevron"></div>
                    </div>
                    @foreach ($specialty->qualifications as $qualification)
                    <div class="qualifications_block">
                        <div class="qualifications">
                            <div class="info">
                                <span class="sign accent"><b>Квалификация</b></span>
                                <span>{{ $qualification->qualification }}</span>
                            </div>
                            <div class="combine">
                                <div class="info">
                                    <span class="sign accent"><b>Срок обучения</b></span>
                                    <span>{{ $qualification->term_study }}</span>
                                </div>
                                <div class="info">
                                    <span class="sign accent"><b>Количество мест</b></span>
                                    <span>{{ $qualification->number_seats }} мест</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<section id="info" class="block_column info">
    <h1 class="accent">Информация о приеме {{ date('Y') }}</h1>
    <div class="block_info block_column_content">
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
                <span>Статус приема</span>
                <span class="status"><b>{{ $deadline->status }}</b></span>
            </div>
        </div>
        <div class="block documents">
            <div class="title">
                <span class="large"><b>Пакет необходимых документов</b></span>
                <a href="/request" class="button">У меня все есть</a>
            </div>
            @include('layouts.documents')
        </div>
    </div>
    <div class="block_info block_column_content">
        <div class="block request ajax_request">
            <div class="title">
                <span class="large"><b>Как проходит подача заявления</b></span>
                <div class="switch_block">
                    <a onclick="switch_click('/?req=1&institution={{ request('institution', 1) }}', ['.ajax_request .list_block'], '.ajax_request')" class="switch active disabled">Онлайн</a>
                    <a onclick="switch_click('/?req=2&institution={{ request('institution', 1) }}', ['.ajax_request .list_block'], '.ajax_request')" class="switch">Офлайн</a>
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
<section id="contacts" class="block_column">
    <h1>Контактная информация</h1>
    <div class="block_contacts block_column_content">
        <div class="block">
            @if (request('institution', 1) == 1)
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
            @else 
            <div class="list">
                <span class="large accent"><b>Адрес</b></span>
                <span class="middle">Республика Хакасия, р.п. Усть-Абакан,<br>ул. Добровольского, 14</span>
            </div>
            <div class="list">
                <span class="large accent"><b>Телефон</b></span>
                <span class="middle"><a href="tel:+73902343557">+7 390 322 - 11 - 75</a></span>
            </div>
            <div class="list">
                <span class="large accent"><b>Электронная почта</b></span>
                <span class="middle"><a href="mailto:kollege@khpk.ru">pu12chakasia@yandex.ru</a></span>
            </div>
            @endif
        </div>
        <div class="block map">
            @if (request('institution', 1) == 1)
            <iframe src="https://yandex.ru/map-widget/v1/-/CCU4YLq1TA" frameborder="0" allowfullscreen="true" style="position:relative;"></iframe>
            @else
            <iframe src="https://yandex.ru/map-widget/v1/-/CCU44JAZcB" frameborder="0" allowfullscreen="true" style="position:relative;"></iframe>
            @endif
        </div>
    </div>
</section>
<section id="feedback" class="block_column">
    <h1 class="accent">Остались вопросы?</h1>
    <div class="illustration"></div>
    <div class="block_feedback block_column_content">
        <form method="post" class="form_block">
            @csrf
            <span class="title">Напишите сообщение</span>
            <div class="block_input">
                <input type="text" placeholder="Ваше имя" name="name" maxlength="255" class="input">
                <input type="text" placeholder="Номер телефона" name="phone" maxlength="255" class="input">
                <input type="text" placeholder="Email" name="mail" maxlength="255" class="input">
                <textarea type="text" placeholder="Ваше сообщение" name="message" class="input"></textarea>
                <input type="submit" value="Отправить" disabled>
            </div>
        </form>
    </div>
    @include('layouts.message', [
        'title' => 'Форма обратной связи'
    ])
</section>
<div id="loader"></div>
@endsection