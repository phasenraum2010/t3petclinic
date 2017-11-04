
page {
	# CSS files to be included
	includeCSS {
		bootstrap = EXT:t3sbootstrap/Resources/Public/Contrib/Bootstrap/scss/bootstrap.scss
		bootstrap.forceOnTop = 1

		fontawesome = EXT:t3sbootstrap/Resources/Public/Contrib/Fontawesome/css/font-awesome.min.css

		lightbox = EXT:t3sbootstrap/Resources/Public/Contrib/Lightbox/css/baguetteBox.min.css

		t3sbootstrap = EXT:t3sbootstrap/Resources/Public/Styles/t3sbootstrap.css

		stickyFooter = EXT:t3sbootstrap/Resources/Public/Styles/stickyFooter.css
		stickyFooter.if {
			isTrue.cObject = TEXT
			isTrue.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:footer_sticky
		}

		megaMenu = EXT:t3sbootstrap/Resources/Public/Styles/megaMenu.css
		megaMenu.if {
			isTrue.cObject = TEXT
			isTrue.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:navbar_megamenu
		}

		codesnippet = EXT:t3sbootstrap/Resources/Public/Contrib/Codesnippet/default.css
		codesnippet.if.isTrue = {$bootstrap.extconf.codesnippet}
	}

	# JS to be included
	includeJSFooterlibs {
		jquery = EXT:t3sbootstrap/Resources/Public/Contrib/jquery.min.js
		jquery.forceOnTop = 1

		popper = EXT:t3sbootstrap/Resources/Public/Contrib/popper.min.js

		bootstrap = EXT:t3sbootstrap/Resources/Public/Contrib/Bootstrap/js/bootstrap.min.js
	}
	includeJSFooter {

		jqueryeasing = EXT:t3sbootstrap/Resources/Public/Contrib/jquery.easing.min.js

		lightbox = EXT:t3sbootstrap/Resources/Public/Contrib/Lightbox/js/baguetteBox.min.js

		codesnippet = EXT:t3sbootstrap/Resources/Public/Contrib/Codesnippet/highlight.pack.js
		codesnippet.if.isTrue = {$bootstrap.extconf.codesnippet}

	}

	jsFooterInline.4 = TEXT
	jsFooterInline.4.value (

	hljs.initHighlightingOnLoad();


	)
	jsFooterInline.4.if.isTrue = {$bootstrap.extconf.codesnippet}
	jsFooterInline.5 < temp.jsFooterInline
	jsFooterInline.5.wrap = jQuery(function() {|});
}

temp.jsFooterInline >
