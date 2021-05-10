$(function() {
    $(document).on('click', '.specialties .specialty_qualifications', function(e){
        e.stopPropagation();
        if ($(this).find('.qualifications_block').css('display') == 'none') {
            $(this).find('.qualifications_block').fadeIn(200);
            $(this).addClass('active');
        }
        else {
            $(this).find('.qualifications_block').fadeOut(200);
            $(this).removeClass('active');
        }
    });
});