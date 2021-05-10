$(function() {
    $('#feedback form').submit(() => {
        $('#loader').fadeIn(100);
        $('#loader').append('<div class="ajax_loader"></div>');
        $('#loader').children('.ajax_loader').fadeIn(200);
        $.ajax({
            type: "POST",
            url: '/ajax/feedback',
            data: $('#feedback form').serialize(),
            success: function(data){
                $('#loader').children('.ajax_loader').fadeOut(200);
                setTimeout(() => {
                    $('#loader').children('.ajax_loader').remove();
                }, 500);
                show_message(data);
            },
            error: function(response){
                $('#loader').children('.ajax_loader').fadeOut(200);
                setTimeout(() => {
                    $('#loader').children('.ajax_loader').remove();
                }, 500);
                show_message(response.responseJSON.errors);
            }
        });
        return false;
    });
});