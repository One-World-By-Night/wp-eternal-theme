/**
 * WP Eternal Theme - Frontend JavaScript.
 *
 * @package WPEternalTheme
 */

(function ($) {
	'use strict';

	// Header scroll effect: add .active class after scrolling 20px.
	$(window).scroll(function () {
		if ($(window).scrollTop() > 20) {
			$('.main--header').addClass('active');
		} else {
			$('.main--header').removeClass('active');
		}
	});
})(jQuery);
