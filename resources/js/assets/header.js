$(function(){
    let header = $('header'),
        scrollPrev = 0;
        $(window).scroll(function () {
            var scrolled = $(window).scrollTop();
    
            if (scrolled > header.height() && scrolled > scrollPrev) {
                header.addClass('out');
            } else {
                header.removeClass('out');
            }
    
            scrollPrev = scrolled;
        });
});