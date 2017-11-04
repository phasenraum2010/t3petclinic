# ===============================================================================
# tt_content configuration for gridelements
# ===============================================================================
lib.gridelements.defaultGridSetup {
	cObject =< lib.contentElement
	cObject {
		templateRootPaths {
			0 = EXT:t3sbootstrap/Resources/Private/Templates/Gridelements/
			1 = {$plugin.tx_t3sbootstrap.view.templateRootPath}Gridelements/
		}
	}
}


# ===============================================================================
# tt_content configuration
# ===============================================================================
tt_content {

	# **********************************************************
	#
	# GRIDELEMENTS
	#
	# **********************************************************
	gridelements_pi1.20.10.setup {

		# **********************************************************
		# Grid System
		# **********************************************************
		two_columns < lib.gridelements.defaultGridSetup
		two_columns.cObject.templateName = TwoColumns

		three_columns < lib.gridelements.defaultGridSetup
		three_columns.cObject.templateName = ThreeColumns

		four_columns < lib.gridelements.defaultGridSetup
		four_columns.cObject.templateName = FourColumns

		# **********************************************************
		# Wrapper
		# **********************************************************
		card_wrapper < lib.gridelements.defaultGridSetup
		card_wrapper.cObject.templateName = CardWrapper
		card_wrapper.columns.0.renderObj < tt_content.t3sbs_card

		button_group < lib.gridelements.defaultGridSetup
		button_group.cObject.templateName = Buttongroup
		button_group.columns.0.renderObj < tt_content.t3sbs_button

		autoLayout_row < lib.gridelements.defaultGridSetup
		autoLayout_row.cObject.templateName = AutoLayoutRow

		container < lib.gridelements.defaultGridSetup
		container.cObject.templateName = Container

		background_wrapper < lib.gridelements.defaultGridSetup
		background_wrapper.cObject.templateName = BackgroundWrapper

		parallax_wrapper < lib.gridelements.defaultGridSetup
		parallax_wrapper.cObject.templateName = ParallaxWrapper

		carousel_container < lib.gridelements.defaultGridSetup
		carousel_container.cObject.templateName = CarouselContainer
		carousel_container.columns.0.renderObj < tt_content.t3sbs_carousel

		# **********************************************************
		# Collapse / Container & Accordion
		# **********************************************************
		collapsible_accordion < lib.gridelements.defaultGridSetup
		collapsible_accordion.cObject.templateName = Collapsible
		collapsible_accordion.columns.0.renderObj =< tt_content

		collapsible_container < lib.gridelements.defaultGridSetup
		collapsible_container.cObject.templateName = CollapsibleContainer
		collapsible_container.columns.0.renderObj =< tt_content.gridelements_pi1

		# **********************************************************
		# Modal
		# **********************************************************
		modal < lib.gridelements.defaultGridSetup
		modal.cObject.templateName = Modal

	}
}


