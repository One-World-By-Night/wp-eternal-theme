/**
 * WP Eternal Theme - TablePress admin filtering.
 *
 * Hides TablePress tables not owned by the current author.
 * Only runs when the user has the 'author' role.
 *
 * @package WPEternalTheme
 */

jQuery(document).ready(function ($) {
	if (typeof customAdminData === 'undefined' || !customAdminData.user_role) {
		return;
	}

	var currentUrl = new URL(window.location.href);
	var pageValue = currentUrl.searchParams.get('page');

	if (pageValue !== 'tablepress') {
		return;
	}

	var count = 0;
	$('#the-list tr').each(function () {
		var authorName = $(this).find('.column-table_author').text().trim();
		if (customAdminData.display_name !== authorName) {
			$(this).hide();
		} else {
			count++;
		}
	});

	$('.displaying-num').text(count + ' tables');
});
