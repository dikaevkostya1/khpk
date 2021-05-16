@extends('layouts.admin.app')
@push('styles')
    <link rel="stylesheet" href="{{ mix('/css/request.css') }}">
@endpush
@section('header')
    @include('layouts.admin.header')
@endsection
@section('content') 
<section id="request">
<form method="post" class="block_column">
        @csrf
        <div class="title_block">
            <h1 class="gradient">Прием абитуриента</h1>
            <div class="switches">
                <div class="switch_block">
                    <a onclick="switch_click('/admin/request?format=1&institution={{ $admin->institution_id }}', ['#request'], '#loader')" class="switch @if(request('format', 1) == 1) active disabled @endif">Очное</a>
                    <a onclick="switch_click('/admin/request?format=2&institution={{ $admin->institution_id }}', ['#request'], '#loader')" class="switch @if(request('format', 1) == 2) active disabled @endif">Заочное</a>
                </div>
            </div>
        </div>
@if ($deadline)
<div class="block_request">
    <div class="form_block">
        <span class="title">Основные данные</span>
        <div class="block_input">
            <input type="text" placeholder="Имя" name="name" maxlength="255" class="input">
            <input type="text" placeholder="Фамилия" name="surname" maxlength="255" class="input">
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
                <input type="text" placeholder="Email" name="mail" maxlength="255" class="input">
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
        <span><a href="/download/request/consent.pdf" class="underlined download">Скачать</a></span>
    </div>
</div>
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
            <div class="block rating form_block">
            <span class="title">Документ об образовании</span>
            <div class="block_input">
                <div class="input_row">
                    <input type="text" placeholder="Предмет" name="name[]" maxlength="255" class="input subject">
                    <input type="text" name="eval" maxlength="1" class="input eval">
                </div>
                <div class="input_row">
                    <input type="text" placeholder="Предмет" name="name[]" maxlength="255" class="input subject">
                    <input type="text" name="eval" maxlength="1" class="input eval">
                </div>
                <div class="input_row">
                    <input type="text" placeholder="Предмет" name="name[]" maxlength="255" class="input subject">
                    <input type="text" name="eval" maxlength="1" class="input eval">
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="specialties slip input">
        <div class="block_form">
            <div class="block">
                <div class="switches">
                    <span class="large"><b>Выберите<br>специальность</b></span>
                    <div class="switch_block2">
                        <a onclick="switch_click('/admin/request?finansing=1&format={{ request('format', 1) }}&institution={{ $admin->institution_id }}', ['.specialties .block'], '.specialties .block')" class="switch @if(request('finansing', 1) == 1) active disabled @endif">Бюджет</a>
                        <a onclick="switch_click('/admin/request?finansing=2&format={{ request('format', 1) }}&institution={{ $admin->institution_id }}', ['.specialties .block'], '.specialties .block')" class="switch @if(request('finansing', 1) == 2) active disabled @endif">Платное</a>
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
                                    <div class="select_button" data-value="{{ $qualification->id }}"></div>
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
<div class="block_request">
    <input type="submit" value="Продолжить" disabled>
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
</section>
@endsection