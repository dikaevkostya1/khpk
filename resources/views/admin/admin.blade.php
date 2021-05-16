@extends('layouts.admin.app')
@section('header')
    @include('layouts.admin.header')
@endsection
@section('content') 
<section id="info">
    <div class="info">
        <div class="block_info block_column_content">
            <div class="block ajax_info">
                <div class="title">
                    <span class="large"><b>Сроки приема</b></span>
                    <div class="switch_block">
                        <a onclick="switch_click('/admin?format=1&institution={{ $admin->institution_id }}', ['.ajax_info .date_time_block', '.ajax_info .status_block'], '.ajax_info')" class="switch active disabled">Очно</a>
                        <a onclick="switch_click('/admin?format=2&institution={{ $admin->institution_id }}', ['.ajax_info .date_time_block', '.ajax_info .status_block'], '.ajax_info')" class="switch">Заочно</a>
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
            <div class="block requests">
                <h1>Заявки</h1>
                <span class="large">Подано заявок <span class="accent">{{ count($requests) }}</span></span>
                <span class="large">Не рассмотрено <span class="accent">{{ count($requests_new) }}</span></span>
                <a class="button">Рассмотреть</a>
            </div>
        </div>
    </div>
    <div class="info">
        <div class="block_info block_column_content">
            <div class="block commission">
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
            </div>
        </div>
    </div>
</section>
@endsection