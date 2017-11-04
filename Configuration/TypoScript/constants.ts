#-------------------------------------------------------------------------------
#	Plugin Constants
#-------------------------------------------------------------------------------

plugin.tx_t3sbootstrap {
	view {
		# cat=plugin.tx_t3sbootstrap/file; type=string; label=Path to template root (FE)
		templateRootPath = EXT:t3sbootstrap/Resources/Private/Templates/
		# cat=plugin.tx_t3sbootstrap/file; type=string; label=Path to template partials (FE)
		partialRootPath = EXT:t3sbootstrap/Resources/Private/Partials/
		# cat=plugin.tx_t3sbootstrap/file; type=string; label=Path to template layouts (FE)
		layoutRootPath = EXT:t3sbootstrap/Resources/Private/Layouts/
	}
}

#-------------------------------------------------------------------------------
#	Constants of t3sbootstrap
#-------------------------------------------------------------------------------

# customcategory=bootstrap-config=* T3SB::Config
# customsubcategory=a-config=Main T3SB Config
# customsubcategory=b-config=Main TYPO3 Config
# customsubcategory=c-config=Other Config
bootstrap.config {
	# cat=bootstrap-config/a-config/10; type=boolean; label=Data for "T3SB Config" on subpages: if disable from rootpage	 or from rootline if enabled (slide).
	rootline = 1
	# cat=bootstrap-config/b-config/10; type=boolean; label=Compress: compress and concatenate JS and CSS.
	compress = 1
	# cat=bootstrap-config/b-config/20; type=boolean; label=Disable Prefix Comment:
	disablePrefixComment = 1
	# cat=bootstrap-config/b-config/30; type=small; label=Robot Meta Name: if "Metatags & Browsertitle" is enabled in the EM config.
	robots = index, follow
	# cat=bootstrap-config/b-config/40; type=small; label=Revisit-after Meta Name: if "Metatags & Browsertitle" is enabled in the EM config.
	revisitAfter = 7 days

	# cat=bootstrap-config/c-config/10; type=boolean; label=Last Modified Content Element: display the date of the last modified content on current page in the footer.
	lastModifiedContentElement = 0
	# cat=bootstrap-config/c-config/20; type=small; label=Date Format: the date format to use in ext:t3sbootstrap.
	dateFormat = d.m.Y

}

# customcategory=bootstrap-image=* T3SB::Fallback image size
# customsubcategory=a-image=Default Image Size
bootstrap.image {
	# cat=bootstrap-image/a-image/10; type=int+; label=Fallback image size in ColPos=0 (in px): only if BE-layout != OneCol && !imgWidth
	default.width.big = 825
	# cat=bootstrap-image/a-image/20; type=int+; label=Fallback image size in ColPos=1 && ColPos=2 (in px): only if BE-layout != OneCol && !imgWidth
	default.width.small = 385
}

# customcategory=bootstrap-extensions=* T3SB::Extensions
# customsubcategory=a-ext=EXT:form
bootstrap.ext {
	# cat=bootstrap-extensions/a-ext/10; type=boolean; label=Ajax Form in Modal: if "Ajax-Form" is available, enable this to open the form in a modal.
	form.modal = 0

}


bootstrap.navbar {
	image.defaultPath = EXT:t3sbootstrap/Resources/Public/Images/bootstrap-solid.svg
	image.width = 30
	image.height = 30
}

bootstrap.info.megamenu = http://four.t3sbootstrap.de/demo/mega-menu/



styles.content.textmedia.maxW = 1140
styles.content.textmedia.maxWInText = 570


# T3SB Config override
bootstrap.config {
	company =
	homepage_uid =
	page_title =
	page_titlealign =
	meta_enable =
	meta_value =
	meta_container =
	meta_class =
	navbar_enable =
	navbar_entrylevel =
	navbar_levels =
	navbar_excludeuiduist =
	navbar_includespacer =
	navbar_justify =
	navbar_sectionmenu =
	navbar_megamenu =
	navbar_hover =
	navbar_brand =
	navbar_image =
	navbar_color =
	navbar_background =
	navbar_container =
	navbar_placement =
	navbar_class =
	navbar_toggler =
	navbar_breakpoint =
	navbar_height =
	navbar_searchbox =
	navbar_lang_uid =
	navbar_lang_hreflang =
	navbar_lang_title =
	jumbotron_enable =
	jumbotron_bgimage =
	jumbotron_fluid =
	jumbotron_position =
	jumbotron_container =
	jumbotron_containerposition =
	jumbotron_class =
	breadcrumb_enable =
	breadcrumb_corner =
	breadcrumb_position =
	breadcrumb_container =
	breadcrumb_containerposition =
	breadcrumb_class =
	sidebar_enable =
	sidebar_rightenable =
	sidebar_levels =
	sidebar_excludeuiduist =
	sidebar_includespacer =
	footer_enable =
	footer_fluid =
	footer_sticky =
	footer_container =
	footer_containerposition =
	footer_class =
	footer_pid =
}