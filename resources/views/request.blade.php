@extends('layouts.app')
@section('title', 'Подача заявки')
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