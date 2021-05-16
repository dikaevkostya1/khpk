@section('header')
    @parent
    @section('nav')
        <a href="/#info">Прием</a>
        <a href="/#contacts">Контакты</a>
    @endsection
    @section('content_header')
    @if(count($requests) == 0)
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
        <input type="hidden" name="institution_id" value="{{ request('institution', 1) }}">
        <div class="title_block">
            <div class="title">
                @if(count($requests) == 0)<div class="stage"><b>{{ $request_stage }} этап</b></div>@endif
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
            <div class="specialties slip input">
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
                            @if(count($specialties) > 0)
                            @foreach ($specialties as $specialty)
                            <div class="specialty_qualifications">
                                <div class="specialty">
                                    <span class="code">{{ $specialty->code }}</span>
                                    <span class="name">{{ $specialty->name }}</span>
                                    <div class="chevron"></div>
                                </div>
                                <div class="qualifications_block">
                                    @foreach ($specialty->qualifications as $qualification)
                                    <div class="qualifications">
                                        <div class="info">
                                            <span class="accent"><b>{{ $qualification->qualification }}</b></span>
                                        </div>
                                        <div class="combine">
                                            <div class="info">
                                                <span class="sign"><b>Срок обучения</b></span>
                                                <span>{{ $qualification->term_study }}</span>
                                            </div>
                                            <div class="info">
                                                <span class="sign"><b>Количество мест</b></span>
                                                <span>{{ $qualification->number_seats }} мест</span>
                                            </div>
                                            @if(in_array($qualification->id, $requests->toArray())) 
                                            @svg('/app/public/img/icons/ok-circle.svg', 'select_ok')
                                            @else
                                            <div class="select_button" data-value="{{ $qualification->id }}"></div>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="specialty_qualifications">
                                <div class="flex-center">
                                    <span>Не найдено</span>
                                </div>
                            </div>
                            @endif
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
        <div class="info">
            <div class="block_info block_column_content">
                <div class="block">
                    <div class="title">
                        <span class="large"><b>Сроки приема на @if(request('format', 1) == 1) очное @else заочное @endif</b></span>
                    </div>
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
                    <div class="status_block">
                        <span>Статус приема</span>
                        <span class="status"><b>{{ $deadline_info->status }}</b></span>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </form>
</section>
@include('layouts.message', [
    'title' => 'Ошибка формы'
])
<script src="{{ mix('/js/request.js') }}"></script>