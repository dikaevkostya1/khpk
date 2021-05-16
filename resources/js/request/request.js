$(function() {
    let form = $('#request form');
    form.on('submit', function(e){
        e.preventDefault();
        $('#loader').fadeIn(100);
        $('#loader').append('<div class="ajax_loader"></div>');
        $('#loader').children('.ajax_loader').fadeIn(200);
        let data = new FormData(this);
        $('#request form .select').each(function(key, element){
            data.append($(this).attr('id'), $(this).data('value'));
        });
        data.append('speciality_id', JSON.stringify($('#request form .specialties').data('value')));
        $.ajax({
            type: "POST",
            url: '/ajax/request/push',
            enctype: 'multipart/form-data',
            data: data,
            processData: false,
            contentType: false,
            success: function(data){
                if (data.redirect == true) window.location.replace(data.redirect_url);
                else {
                    $('body').html(data.view);
                    $('#loader').fadeOut(100);
                }
            },
            error: function(response){
                let data = response.responseJSON.errors;
                $('#loader').children('.ajax_loader').fadeOut(200);
                setTimeout(() => {
                    $('#loader').children('.ajax_loader').remove();
                }, 500);
                show_message(data);
            }
        });
        return false;
    });
    timer_click = function(url) {
        $.get(url).done(function() {
            $('#request form .timer_button').css('display', 'none');
            $('#request form .timer_block').fadeIn(200);
            let seconds = 60,
                int = setInterval(function () {
                    if (seconds > 0) {
                        seconds--;
                        $('#request form .timer_block .time').text(seconds);
                    } else {
                        clearInterval(int);
                        $('#request form .timer_block').css('display', 'none');
                        $('#request form .timer_button').fadeIn(200);
                    }
                }, 1000);
        });
    };
});