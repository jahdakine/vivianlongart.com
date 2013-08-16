/* Top link */
jQuery.fn.topLink = function(settings) {
		settings = jQuery.extend({
		min: 1,
		fadeSpeed: 200
	}, settings);
	return this.each(function() {
		//listen for scroll
		var el = $(this);
		el.hide(); //in case the user forgot
		$(window).scroll(function() {
			if($(window).scrollTop() >= settings.min) {
				el.fadeIn(settings.fadeSpeed);
			} else {
				el.fadeOut(settings.fadeSpeed);
			}
		});
	});
};
var top_link = $('#top-link');
//top link
top_link.topLink({
	min: 50,
	fadeSpeed: 500
});
top_link.click(function(e) {
	e.preventDefault();
	$('body,html').animate({scrollTop:0},800);
});
