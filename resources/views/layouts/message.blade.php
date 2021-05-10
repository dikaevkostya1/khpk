@section('message')
<div id="message" @if ($errors->all() || isset($message)) style="display: block;" @endif>
    <div class="block">
        <div class="title">
            @svg('/app/public/img/icons/exclamation-circle.svg', 'icon')
            <h3>{{ $title }}</h3>
        </div>
        <div class="message">
            @if ($errors->all())
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            @elseif(isset($message))
                <p>{{ $message }}</p>
            @endif
        </div>
        <a onclick="close_message()" class="close button">Закрыть</a>
    </div>
</div>
@show