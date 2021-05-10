$(function() {
    $('form .input').change(function() {
        $('form .input').each(function(index, element){
            if ($(element).val() != '' || $(element).data('value')) $(element).attr('data-input', true);
            else $(element).attr('data-input', false);
        });
        if ($('form .input[data-input="true"]').length == $('form .input').length) $('form input[type="submit"]').removeAttr('disabled');
        else $('form input[type="submit"]').attr('disabled', 'disabled');
    });
});
