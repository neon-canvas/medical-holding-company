import 'views/home';

// Window history back
function goBack() {
	window.history.back();
}

// --- Normal functions --- //
jQuery(function() {

	// Toggle mobile menu
	jQuery('.menu-toggle').click(function() {
		jQuery(this).toggleClass('active');
		jQuery('header').toggleClass('mobile');
		jQuery('#side-menu').toggleClass('active');
		jQuery('body').toggleClass('active');
	});

	// Video player
	jQuery('.play').click(function() {
		jQuery(this).siblings('video').addClass('fade');
		jQuery(this).parent().addClass('fade');
	});

    // Get current year for footer copyright
	var currentYear = (new Date()).getFullYear();
	jQuery('footer span.year').text(currentYear);
});

// Add in Expand Toggle to Nav Items With Children
jQuery('#side-menu #primary-menu li').each(function() {
  if (jQuery(this).children('ul').size() >= 1) {
      jQuery(this).addClass('hasChild');
      jQuery(this).append('<a class="expand"></a>');
  }
});

// Show Child Pages When Toggle is Clicked
jQuery('#side-menu .expand').click(function() {
  jQuery(this).parent().children('ul').toggleClass('active');
  jQuery(this).toggleClass('active');
});

// Add Class on Scroll
jQuery(window).scroll(function() {
	var scroll = jQuery(window).scrollTop();

	if (scroll >= 150) {
		jQuery("header").addClass("active");
	} else {
		jQuery("header").removeClass("active");
	}
});

jQuery('.theme-picker').click(function() {
	jQuery('.options').toggleClass('active');
	jQuery('.theme-picker .cta-text').toggleClass('active');
});
