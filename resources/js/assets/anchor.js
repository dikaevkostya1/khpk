$(function() {
    let header = $('header');
    header.on("click", "a.anchor", function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top - 180;
        $('body,html').animate({scrollTop: top}, 300);
    });
});