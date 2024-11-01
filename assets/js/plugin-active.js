(function ($) {
	"use strict";
	

    $(window).on('scroll', function () {
        function winScrollPosition() {
            var scrollPos = $(window).scrollTop(),
            winHeight = $(window).height();
            var scrollPosition = Math.round(scrollPos + winHeight / 1.2);
            return scrollPosition;
        }
        $('.odometer').each(function () {
            var elemOffset = $(this).offset().top;
            if (elemOffset < winScrollPosition()) {
            $(this).html($(this).data('count-to'));
            }
        });
    });


})(jQuery);

new ModalVideo('.xa-youtube-btn');

// Check if the element with ID 'typed' exists
var typedElement = document.getElementById('typed');

if (typedElement !== null) {
    // Typed JS
    var typed = new Typed('#typed', {
        stringsElement: '#typed-strings',
        loop: true,
        typeSpeed: 70,
        backSpeed: 30,
    });
}