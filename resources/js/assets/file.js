$(function() {
    $('form .button_download input[type=file]').on('change', function() {
        if (this.files[0].size / 1024 / 1024 > 10) {
            show_message(['Файл слишком большой. Максимальный размер 10mb']);
            $(this).val('');
        }
        else {
            $(this).closest('.button_download').css('display', 'none');
            $(this).closest('.button_download').siblings('.apply_block').css('display', 'flex').hide().fadeIn(200);
        }
    });
});