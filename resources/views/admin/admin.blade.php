@extends('layouts.admin.app')
@section('content')
@section('header')
    {{ $admin->name }}
    <a href="/logout/admin">Выход</a>
@endsection
@section('content') 
<h1>Сроки приема {{ $now->format('Y') }}</h1>
<section>
    <a href="/admin/?d=1">Очное</a>
    <a href="/admin/?d=2">Заочное</a>
    @if ($deadline)
        {{ $deadline->start->format('Y-m-d H:i') }}
        {{ $deadline->ending->format('Y-m-d H:i') }}
        @if ($deadline->start <= $now && $deadline->ending >= $now)
            Открыт
        @elseif ($deadline->start > $now)
            Не начат
        @elseif ($deadline->ending < $now)
            Завершился
        @endif
    @else
        Сроки не установлены
    @endif
    <form action="/admin/deadline" method="post" class="form_block">
        @csrf
        <input type="hidden" value="{{ $format }}" name="format">
        <input type="datetime-local" name="start" value="{{ $deadline ? $deadline->start->format('Y-m-d\TH:i') : $now->format('Y-m-d\TH:i') }}">
        <input type="datetime-local" name="ending" value="{{ $deadline ? $deadline->ending->format('Y-m-d\TH:i') : $now->format('Y-m-d\TH:i') }}">
        <input type="submit" value="Сохранить">
    </form>
</section>
@endsection
@endsection