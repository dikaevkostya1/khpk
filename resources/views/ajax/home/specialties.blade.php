<form action="" method="POST">
    <div class="switches">
        <div class="switch_block2">
            <div class="switch active">Очное</div>
            <div class="switch">Заочное</div>
        </div>
        <div class="switch_block2">
            <div class="switch active">Бюджет</div>
            <div class="switch">Платное</div>
        </div>
    </div>
    <div class="list">
        @foreach ($specialties as $specialty)
            <div class="specialty">
                <span class="code">{{ $specialty->code }}</span>
                <span class="name">{{ $specialty->name }}</span>
                <div class="chevron"></div>
            </div>
        @endforeach
    </div>
</form>