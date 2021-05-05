@section('message')
<div id="message">
    <div class="block">
        <div class="title">
            @svg('/app/public/img/icons/exclamation-circle.svg', 'icon')
            <h3>{{ $title }}</h3>
        </div>
        <div class="message">{{ $message ?? '' }}</div>
        <a onclick="close_message()" class="close button">Закрыть</a>
    </div>
</div>
@show