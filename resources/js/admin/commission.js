$(function() {
    let form = $('#info .commission_info');
    form.on('submit', function(e){
        e.preventDefault();
        $('#loader').fadeIn(100);
        $('#loader').append('<div class="ajax_loader"></div>');
        $('#loader').children('.ajax_loader').fadeIn(200);
        let data = new FormData(this);
        $('#info .commission_info .select').each(function(key, element){
            data.append($(this).attr('id'), $(this).data('value'));
        });
        $.ajax({
            type: "POST",
            url: '/admin/ajax/commission',
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
    $('#info .commission_info input[type="text"]').mask('00:00', {clearIfNotMatch: true});
});