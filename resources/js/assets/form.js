$(function() {
    $(document).on('change', 'form', function() {
        $(this).find('.input').each(function(index, element){
            if ($(element).val() || JSON.stringify($(element).data('value'))) $(element).attr('data-input', true);
            else $(element).attr('data-input', false);
        });
        if ($(this).find('.input[data-input="true"]').length == $(this).find('.input').length) $(this).find('input[type="submit"]').removeAttr('disabled');
        else $(this).find('input[type="submit"]').attr('disabled', 'disabled');
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
    let specialties = [];
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
    $('#request form input[name="date_born"]').focusout(function() {
        if ($(this).val().length == 10) {
            let date = $(this).val().split('.');
            let today = new Date();
            let birthDate = new Date(date[2], date[1], date[0]);
            let age = today.getFullYear() - birthDate.getFullYear();
            let m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
            if (age < 18) $('#consent .download').attr('href', '/download/request/consent.pdf');
            else $('#consent .download').attr('href', '/download/request/consent18.pdf');
            $('#consent').css('display', 'flex').hide().fadeIn(200);
        }
        else $('#consent').css('display', 'flex').hide().fadeOut(200);
    });
    $('#info .deadline_info input[type="text"]').mask('00.00', {clearIfNotMatch: true});
});
