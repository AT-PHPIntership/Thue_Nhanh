// back-to-top button
$(document).ready(function() {
    var amountScrolled = 300;

    $(window).scroll(function() {
        if ($(window).scrollTop() > amountScrolled) {
            $('a.back-to-top').fadeIn('medium');
        } else {
            $('a.back-to-top').fadeOut('medium');
        }
    });
    // The Animated Effect
    $('a.back-to-top').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 700);
        return false;
    });
});
