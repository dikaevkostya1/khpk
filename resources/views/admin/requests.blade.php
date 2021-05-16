@extends('layouts.admin.app')
@section('header')
    @include('layouts.admin.header')
@endsection
@section('content') 
<section id="requests">
    <div class="title_block">
        <div class="title">
            <h1 class="gradient">Заявки</h1>
            <div class="count"><b>{{ count($requests) }}</b></div>
        </div>
        <div class="switches">
            <div class="switch_block">
                <a onclick="switch_click('/request?format=1&institution={{ request('institution', 1) }}', ['#request'], '#loader')" class="switch @if(request('format', 1) == 1) active disabled @endif">Очное</a>
                <a onclick="switch_click('/request?format=2&institution={{ request('institution', 1) }}', ['#request'], '#loader')" class="switch @if(request('format', 1) == 2) active disabled @endif">Заочное</a>
            </div>
        </div>
    </div>
</section>
@endsection