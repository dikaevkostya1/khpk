@section('header')
    @parent
    @section('nav')
        <a href="/#info">Прием</a>
        <a href="/#contacts">Контакты</a>
    @endsection
@endsection
<section id="request">
    <form method="post" class="block_column">
        @csrf
        <div class="title_block">
            <div class="title">
                <div class="stage"><b>{{ $request_stage }} этап</b></div>
                <h1 class="gradient">Отправка заявки</h1>
            </div>
            <div class="switches">
                <div class="switch_block">
                    <a onclick="switch_click('/request?institution=1&format={{ request('format', 1) }}', ['#request'], '#loader')" class="switch @if(request('institution', 1) == 1) active disabled @endif">Колледж</a>
                    <a onclick="switch_click('/request?institution=2&format={{ request('format', 1) }}', ['#request'], '#loader')" class="switch @if(request('institution', 1) == 2) active disabled @endif">Филиал</a>
                </div>
                <div class="switch_block">
                    <a onclick="switch_click('/request?format=1&institution={{ request('institution', 1) }}', ['#request'], '#loader')" class="switch @if(request('format', 1) == 1) active disabled @endif">Очное</a>
                    <a onclick="switch_click('/request?format=2&institution={{ request('institution', 1) }}', ['#request'], '#loader')" class="switch @if(request('format', 1) == 2) active disabled @endif">Заочное</a>
                </div>
            </div>
            @if ($deadline)
            <input type="submit" value="Отправить" disabled>
            @else
            <a href="/" class="button">На главную</a>
            @endif
        </div>
        @if ($deadline)
        <div class="block_request slip">
            <div class="block_column info">
                <div class="block_info">
                    <div class="block documents">
                        <div class="title">
                            <span class="large"><b>Загрузите документы архивом</b></span>
                            <div class="flex-center apply_block">
                                @svg('/app/public/img/icons/ok-circle.svg', 'apply')
                                <span>Загружено</span>
                            </div>
                            <a class="button button_download">Загрузить<input type="file" name="documents" accept="application/zip,application/x-rar-compressed,application/x-7z-compressed" class="input"></a>
                        </div>
                        @include('layouts.documents')
                    </div>
                </div>
            </div>
            <div class="specialties slip">
                <div class="block_form">
                    <div class="block">
                        <div class="switches">
                            <span class="large"><b>Выберите<br>специальность</b></span>
                            <div class="switch_block2">
                                <a onclick="switch_click('/request?finansing=1&format={{ request('format', 1) }}&institution={{ request('institution', 1) }}', ['.specialties .block'], '.specialties .block')" class="switch @if(request('finansing', 1) == 1) active disabled @endif">Бюджет</a>
                                <a onclick="switch_click('/request?finansing=2&format={{ request('format', 1) }}&institution={{ request('institution', 1) }}', ['.specialties .block'], '.specialties .block')" class="switch @if(request('finansing', 1) == 2) active disabled @endif">Платное</a>
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
                                            @if(!in_array($qualification->id, $requests)) 
                                            <a class="button">Выбрать</a>
                                            @endif
                                        </div>
                                        @if(in_array($qualification->id, $requests)) 
                                        <span>Вы подали заявку на эту специальность</span>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footnote">
            @svg('/app/public/img/icons/exclamation-circle.svg', 'icon')
            <div class="text">
                <h2 class="title">Внимание</h2>
                <p>Документы считаются принятыми к рассмотрению после получения абитуриентом подтверждения от приемной комиссии в личном кабинете.</p>
                <p>Предоставляя документы, необходимо помнить, что если абитуриент оказывается в числе рекомендованных к зачислению, то необходимо предоставить в приемную комиссию оригиналы тех документов, сканированные копии которых были им направлены.</p>
                <p>Приемная комиссия оставляет за собой право не принять документы, отправленные абитуриентом, если они не соответствуют установленным <a href="/download/request/rules.doc" class="underlined download">Правилами приема</a> требованиям или невозможностью прочитать текст документов.</p>
            </div>
        </div>
        @else
        <h1>Прием на @if(request('format', 1) == 1) очное @else заочное @endif еще не начался</h1>
        <div class="date_time_block">
            <div class="block_circle from">
                <span class="text">{{ $deadline_info->start }}</span>
                <span class="sign">{{ $deadline_info->start_sign }}</span>
            </div>
            <div class="jump">
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
            </div>
            <div class="block_circle">
                <span class="text">{{ $deadline_info->ending }}</span>
                <span class="sign">{{ $deadline_info->ending_sign }}</span>
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