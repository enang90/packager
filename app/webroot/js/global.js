/**
 * Close button for flash messages (errors, warnings, info)
 */
jQuery(function ($) {
	$("section.flash > div").append($("<a class='close'></a>").click(function () {
		$(this).parent().slideUp();
	})
)});
