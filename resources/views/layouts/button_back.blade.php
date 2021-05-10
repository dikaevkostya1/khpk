<a href="@if(isset($url)) {{ $url }} @else {{ url()->previous() }} @endif " class="button_back">
    @svg('/app/public/img/icons/chevron-left.svg', 'chevron')
    <span>Назад</span>
</a>