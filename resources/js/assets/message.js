$(function(){
    show_message = function(data) {
        $('#message .message').html('');
        $.each(data, function(key, value){
            $('#message .message').append('<p>' + value + '</p>');
        });
        $('#loader').fadeIn(100);
        $('#message').fadeIn(200);
    };
    close_message = function() {
        $('#message').fadeOut(200);
        $('#loader').fadeOut(100);
    }
});