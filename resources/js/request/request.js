$(function() {
    let form = $('#request form');
    form.on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/request/push',
            enctype: 'multipart/form-data',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(data){
                if (data.redirect == true) window.location.replace(data.redirect_url);
                else $('main').html(data.view);
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