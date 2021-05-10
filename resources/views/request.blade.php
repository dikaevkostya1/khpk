@extends('layouts.app')
@section('title', 'Подача заявки')
@push('styles')
    <link rel="stylesheet" href="{{ mix('/css/request.css') }}">
@endpush
@section('header')
    @parent
    @section('logo')
        @include('layouts.button_back')
        @parent
    @endsection
    @section('content_header')
    <div class="request_stage">
        <div class="circle active">1</div>
        <div class="line @if($request_stage == 1) active @elseif($request_stage > 1) full_active @endif"></div>
        <div class="circle @if($request_stage >= 2) active @endif">2</div>
        <div class="line @if($request_stage == 2) active @elseif($request_stage > 2) full_active @endif"></div>
        <div class="circle @if($request_stage == 3) active @endif">3</div>
    </div>
    @endsection
@endsection
@section('content')
    @switch($request_stage)
        @case(1)
            @include('ajax.request.enrolle')
            @break
        @case(2)
            @include('ajax.request.verified')
            @break
        @case(3)
            @include('ajax.request.request')
            @break
    @endswitch
@endsection