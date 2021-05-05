$(function() {
    $('#feedback form').submit(() => {
        $.post(
            '/ajax/feedback',
            $('#feedback form').serialize(),
            function(msg) {
                msg = [msg];
                show_message(msg);
            }
        );
        return false;
    });
});