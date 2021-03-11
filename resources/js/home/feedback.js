$(function() {
    $('#feedback form').submit(() => {
        $.post(
            '/ajax/feedback',
            $('#feedback form').serialize(),
            function(msg) {
                $("#feedback form").find('input').val('');
                $('#feedback .message').html(msg);
            }
        );
        return false;
    });
});