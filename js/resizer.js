	var ww = document.body.clientWidth;

	$(document).ready(function() {
		$(".nav li a").each(function() {
			if ($(this).next().length > 0) {
				$(this).addClass("parent");
			}
		});

		$(".toggleMenu").click(function(e) {
			e.preventDefault();
			$(this).toggleClass("active");
			$(".nav").toggle();
		});
		adjustMenu();
	});

	$(window).bind('resize orientationchange', function() {
		ww = document.body.clientWidth;
		adjustMenu();
	});

	var adjustMenu = function() {
		var widthBar = 480; //Match this with Media Query in nav.css
		if (ww < widthBar) {
			$(".toggleMenu").css("display", "block");
			if (!$(".toggleMenu").hasClass("active")) {
				$(".nav").hide();
			} else {
				$(".nav").show();
				//console.log("show");
			}
			$(".nav li").unbind('mouseenter mouseleave');
			$(".nav li a.parent").unbind('click').bind('click', function(e) {
				// must be attached to anchor element to prevent bubbling
				e.preventDefault();
				$(this).parent("li").toggleClass("hover");
			});
		}
		else if (ww >= widthBar) {
			$(".toggleMenu").css("display", "none");
			$(".nav").show();

			$(".nav li").removeClass("hover");
			$(".nav li a").unbind('click');
			$(".nav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
			// must be attached to li so that mouseleave is not triggered when hover over submenu
				$(this).toggleClass('hover');
			});
		}
	};