$(function() {
    $(document).on('click','.select',function(e){
        e.stopPropagation();
        $(this).find('.list_option').fadeIn(200);
        $(this).addClass('active');
    });
    $(document).on('click', '.select .option', function(e){
        e.stopPropagation();
        $(this).closest('.select').data('value', $(this).data('value'));
        $(this).closest('.select').attr('data-input', true);
        $(this).closest('.select').find('.text').text($(this).text()).addClass('active');
        $(this).closest('.select').removeClass('active');
        $(this).parent().fadeOut(200);
    });
});