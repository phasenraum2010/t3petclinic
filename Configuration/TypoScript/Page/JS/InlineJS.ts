
temp.jsFooterInline = COA
temp.jsFooterInline {

5 = TEXT
5.value (


	// lightbox - page.jsFooterInline.5.5
	baguetteBox.run(".gallery");

)

6 = TEXT
6.value (


	// dropdown menu - page.jsFooterInline.5.6
	$(".dropdown-menu a.dropdown-toggle").on("click", function(e) {
		if (!$(this).next().hasClass("show")) {
			$(this).parents(".dropdown-menu").first().find(".show").removeClass("show");
		}
		var $subMenu = $(this).next(".dropdown-menu");
		$subMenu.toggleClass("show");

		$(this).parents("li.nav-item.dropdown.show").on("hidden.bs.dropdown", function(e) {
			$(".dropdown-submenu .show").removeClass("show");
		});

		return false;
	});

)

7 = TEXT
7.value (


	// Sectionmenu - page.jsFooterInline.5.7
	$(".section-menu a.nav-link").bind("click", function(event) {
		event.preventDefault(event);
		var anchor = $(this).attr("href");
		$("html, body").stop().animate({
			scrollTop: $(anchor).offset().top
		}, 1500, "easeInOutExpo");
	});

)

8 = TEXT
8.value (


	// link to top - page.jsFooterInline.5.8
	var offset = 220;
	var duration = 500;
	$(window).scroll(function() {
		if ($(this).scrollTop() > offset) {
			$(".back-to-top").fadeIn(duration);
		} else {
			$(".back-to-top").fadeOut(duration);
		}
	});
	$(".back-to-top").click(function(event) {
		event.preventDefault(event);
		$("html, body").animate({scrollTop: 0}, duration);
		return false;
	});

)
8.if.isTrue.data = page:tx_t3sbootstrap_linkToTop

9 = TEXT
9.value (


	// Sticky Footer - page.jsFooterInline.5.9
	var footerHeight = $("#page-footer").outerHeight();
	if ( $("#page-footer").hasClass("footer-sticky") ) {
		$("body").css("margin-bottom", footerHeight+"px");
	}

)
9.if {
	isTrue.cObject = TEXT
	isTrue.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:footer_sticky
}


10 = TEXT
10.value (


	// Carousel - page.jsFooterInline.5.10
	var carousel = $( ".carousel .carousel-inner .carousel-item:first-child" );
	if ( carousel.length ) {
		carousel.addClass( "active" );
	}

)


11 = TEXT
11.value (


	// Mega menu - page.jsFooterInline.5.11
	$(document).on('click', '.mega-dropdown', function(event) {
	  event.stopPropagation()
	})

)
11.if {
	isTrue.cObject = TEXT
	isTrue.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:navbar_megamenu
}


50 = TEXT
50.value (


	// Navbar hover - page.jsFooterInline.5.50
	function navbarHover() {
		$("ul.navbar-nav .dropdown, ul.navbar-nav .dropdown-submenu").hover(function() {
			$(this).find(" > .dropdown-menu").stop(true, true).delay(200).fadeIn();
			$(this).addClass("show");
			$(this).next(".dropdown-menu").addClass("show");
			$(this).next("a").attr("aria-expanded","true");
		}, function() {
			$(this).find(" > .dropdown-menu").stop(true, true).delay(200).fadeOut();
			$(this).removeClass("show");
			$(this).next(".dropdown-menu").removeClass("show");
			$(this).next("a").attr("aria-expanded","false");
		});
	}
)
50.if {
	isTrue.cObject = TEXT
	isTrue.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:navbar_hover
}

# Navbar hover depends on the breakpoint in navbar config
51 = TEXT
51.value (

	// Navbar hover - page.jsFooterInline.5.51
	if ($(window).width() > 576) {
		navbarHover();
	}
)
51.if {
	isTrue.cObject = TEXT
	isTrue.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:navbar_hover
	value.data = register:breakpoint
	equals = sm
}
52 = TEXT
52.value (

	// Navbar hover - page.jsFooterInline.5.52
	if ($(window).width() > 768) {
		navbarHover();
	}
)
52.if {
	isTrue.cObject = TEXT
	isTrue.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:navbar_hover
	value.data = register:breakpoint
	equals = md
}
53 = TEXT
53.value (

	// Navbar hover - page.jsFooterInline.5.53
	if ($(window).width() > 992) {
		navbarHover();
	}
)
53.if {
	isTrue.cObject = TEXT
	isTrue.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:navbar_hover
	value.data = register:breakpoint
	equals = lg
}
54 = TEXT
54.value (

	// Navbar hover - page.jsFooterInline.5.54
	if ($(window).width() > 1200) {
		navbarHover();
	}
)
54.if {
	isTrue.cObject = TEXT
	isTrue.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:navbar_hover
	value.data = register:breakpoint
	equals = xl
}


}