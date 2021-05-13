$(function() {
    let form = $('#request form');
    let specialties = [];
    form.on('submit', function(e){
        e.preventDefault();
        $('#loader').fadeIn(100);
        $('#loader').append('<div class="ajax_loader"></div>');
        $('#loader').children('.ajax_loader').fadeIn(200);
        let data = new FormData(this);
        $('#request form .select').each(function(key, element){
            data.append($(this).attr('id'), $(this).data('value'));
        });
        data.append('speciality_id', JSON.stringify(specialties));
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
    $('#request form input[name="date_born"]').focusout(function() {
        if ($(this).val().length == 10) {
            let date = $(this).val().split('.');
            let today = new Date();
            let birthDate = new Date(date[2], date[1], date[0]);
            let age = today.getFullYear() - birthDate.getFullYear();
            let m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
            if (age < 18) $('#consent .download').attr('href', '/download/consent/consent.pdf');
            else $('#consent .download').attr('href', '/download/consent/consent18.pdf');
            $('#consent').css('display', 'flex').hide().fadeIn(200);
        }
        else $('#consent').css('display', 'flex').hide().fadeOut(200);
    });
    $('#request form input[name="date_born"]').mask('00.00.0000', {clearIfNotMatch: true});
    $('#request form input[name="passport_date"]').mask('00.00.0000', {clearIfNotMatch: true});
    $('#request form input[name="passport"]').mask('0000 000000', {clearIfNotMatch: true});
    $('#request form input[name="education_ending"]').mask('0000', {clearIfNotMatch: true});
    $('#request form input[name="education"]').mask('000000 0000000', {clearIfNotMatch: true});
    $('#request form input[name="phone"]').mask('8 000 000 - 00 - 00', {clearIfNotMatch: true});
    $('#request form .code .input').keyup(function () {
        if ($(this).is(':last-child') && this.value.length == this.maxLength) {
            $(this).blur();
        }
        else if (this.value.length == this.maxLength) {
            $(this).next('.input').focus();
        }
        else $(this).prev('.input').focus();
    });
    $(document).on('click','#request form .select_button',function(e){
        e.stopPropagation();
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            specialties.splice(specialties.indexOf($(this).data('value')),1);
        }
        else {
            $(this).addClass('active');
            specialties.push($(this).data('value'));
            $(this).closest('.specialties').data('value', specialties);
        }
        if (specialties.length == 0) {
            $(this).closest('.specialties').attr('data-input', false);
            $('form input[type="submit"]').attr('disabled', 'disabled');
        }
        else {
            $(this).closest('.specialties').attr('data-input', true);
            $('form input[type="submit"]').removeAttr('disabled');
        }
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