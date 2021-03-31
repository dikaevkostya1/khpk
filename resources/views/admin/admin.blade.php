@extends('layouts.admin.app')
@section('content')
<section>
    {{ $admin->name }}
    <a href="/logout/admin">Выход</a>
</section>
@endsection