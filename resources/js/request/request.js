$(function() {
    let form = $('#request form');
    $('main').on('submit', form, function () {
        $.ajax({
            type: "POST",
            url: '/request/push',
            data: form.serialize(),
            success: function(data){
                $('main').html(data.view);
            },
            error: function(response){
                let data = response.responseJSON.errors;
                $('#request .message').html('');
                $.each(data, function(key , value){
                    $('#request .message').append('<p>' + value + '</p>');
                });
            }
        });
        return false;
    });
});