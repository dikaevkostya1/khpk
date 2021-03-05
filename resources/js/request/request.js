$(function() {
    $('#request form').submit(() => {
        $.post(
            '/feedback',
            $('#feedback form').serialize(),
            function(msg) {
                $("#feedback form").trigger('reset');
                $('#feedback .message').html(msg);
            }
        );
        return false;
    });
});