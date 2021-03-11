$(function() {
    let form = $('#request form');
    form.submit(() => {
        $.ajax({
            type: "POST",
            url: '/ajax/request/enrolle',
            data: form.serialize(),
            success: function(data){
                $('#request').html(data.view);
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