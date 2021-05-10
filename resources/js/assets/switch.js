$(function() {
    $(document).on('click', '.switch_block .switch, .switch_block2 .switch', function(e){
        $(this).parent().find('.active').removeClass('active').removeClass('disabled');
        $(this).addClass('active').addClass('disabled');
    });
    switch_click = function(url, object, loader) {
        $('#loader').fadeIn(100);
        $(loader).append('<div class="ajax_loader"></div>');
        $(loader).children('.ajax_loader').fadeIn(200);
        $.get(url).done(function(r) {
            var newDom = $(r);
            $.each(object, function(key, value){
                $(value).replaceWith($(value,newDom));
            });
            window.history.pushState(null, null, url);
            $(loader).children('.ajax_loader').fadeOut(200);
            setTimeout(() => {
                $(loader).children('.ajax_loader').remove();
                $('#loader').fadeOut(100);
            }, 500);
        });
    }
});