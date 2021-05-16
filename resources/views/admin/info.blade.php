@extends('layouts.admin.app')
@section('header')
    @include('layouts.admin.header')
@endsection
@section('content')
<section id="info">
    <div class="info">
        <div class="block_info block_column_content">
            <div class="form_block block ajax_info">
                <div class="title">
                    <span class="large"><b>Сроки приема</b></span>
                    <div class="switch_block">
                        <a onclick="switch_click('/admin/info?format=1', ['.ajax_info .date_time_block', '.ajax_info .status_block', '.ajax_info input[name=format]'], '.ajax_info')" class="switch @if(request('format', 1) == 1) active disabled @endif">Очно</a>
                        <a onclick="switch_click('/admin/info?format=2', ['.ajax_info .date_time_block', '.ajax_info .status_block', '.ajax_info input[name=format]'], '.ajax_info')" class="switch @if(request('format', 1) == 2) active disabled @endif">Заочно</a>
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
                <form method="post" action="/admin/info/deadline" class="deadline_info">
                    @csrf
                    <input type="hidden" name="format" value="{{ request('format', 1) }}">
                    <div class="block_input">
                        <input type="text" placeholder="Дата начала (дд.мм)" name="start" class="input">
                        <input type="text" placeholder="Дата окончания (дд.мм)" name="ending" class="input">
                        <input type="submit" value="Сохранить" disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="info">
        <div class="block_info block_column_content">
            <div class="form_block block commission">
                <div class="title">
                    <span class="large"><b>Режим работы</b></span>
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
                <form method="post" action="/admin/info/commission" class="commission_info">
                    @csrf
                    <input type="hidden" name="format" value="{{ request('format', 1) }}">
                    <div class="block_input">
                        <div id="start_week" class="select input">
                            <span class="text">День начала работы</span>
                            <div class="list_option" style="display: none;">
                                <div class="option" data-value="0">Понедельник</div>
                                <div class="option" data-value="1">Вторник</div>
                                <div class="option" data-value="2">Среда</div>
                                <div class="option" data-value="3">Четверг</div>
                                <div class="option" data-value="4">Пятница</div>
                                <div class="option" data-value="5">Суббота</div>
                                <div class="option" data-value="6">Воскресение</div>
                            </div>
                        </div>
                        <div id="ending_week" class="select input">
                            <span class="text">День окончания работы</span>
                            <div class="list_option" style="display: none;">
                                <div class="option" data-value="0">Понедельник</div>
                                <div class="option" data-value="1">Вторник</div>
                                <div class="option" data-value="2">Среда</div>
                                <div class="option" data-value="3">Четверг</div>
                                <div class="option" data-value="4">Пятница</div>
                                <div class="option" data-value="5">Суббота</div>
                                <div class="option" data-value="6">Воскресение</div>
                            </div>
                        </div>
                        <input type="text" placeholder="Время начала работы" name="start_time" class="input">
                        <input type="text" placeholder="Время окончания работы" name="ending_time" class="input">
                        <input type="text" placeholder="Время начала обеда" name="start_dinner" class="input">
                        <input type="text" placeholder="Время окончания обеда" name="ending_dinner" class="input">
                        <input type="submit" value="Сохранить" disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@include('layouts.message', [
    'title' => 'Ошибка формы'
])
<script src="{{ mix('/js/commission.js') }}"></script>
@endsection