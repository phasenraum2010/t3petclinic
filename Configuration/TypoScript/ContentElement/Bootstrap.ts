# ===============================================================================
# tt_content configuration
# ===============================================================================
tt_content {

	# **********************************************************
	# BOOTSTAP: Button
	# **********************************************************
	t3sbs_button =< lib.contentElement
	t3sbs_button.templateName = Button

	# **********************************************************
	# BOOTSTAP: Card
	# **********************************************************
	t3sbs_card =< lib.contentElement
	t3sbs_card {
		templateName = Card
		dataProcessing {
			10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
			10 {
				references.fieldName = assets
			}
			20 = T3SBS\T3sbootstrap\DataProcessing\GalleryProcessor
			20 {
				maxGalleryWidth = {$styles.content.textmedia.maxW}
				maxGalleryWidthInText = {$styles.content.textmedia.maxWInText}
				columnSpacing = {$styles.content.textmedia.columnSpacing}
				borderWidth = {$styles.content.textmedia.borderWidth}
				borderPadding = {$styles.content.textmedia.borderPadding}
	            defaultImgWidthBig = {$bootstrap.image.default.width.big}
	            defaultImgWidthSmall = {$bootstrap.image.default.width.small}
			}
			223 = T3SBS\T3sbootstrap\DataProcessing\CardProcessor
		}
	}

	# **********************************************************
	# BOOTSTAP: Carousel
	# **********************************************************
	t3sbs_carousel =< lib.contentElement
	t3sbs_carousel {
		templateName = Carousel
		settings.defaultHeaderType = 3
		dataProcessing {
			10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
			10 {
				references.fieldName = image
			}
		}
	}

	# **********************************************************
	# BOOTSTAP: Media object
	# **********************************************************

	t3sbs_mediaobject =< lib.contentElement
	t3sbs_mediaobject {
		templateName = Mediaobject
		dataProcessing {
			10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
			10 {
				references.fieldName = assets
			}
			20 = T3SBS\T3sbootstrap\DataProcessing\GalleryProcessor
			20 {
				maxGalleryWidth = {$styles.content.textmedia.maxW}
				maxGalleryWidthInText = {$styles.content.textmedia.maxWInText}
				columnSpacing = {$styles.content.textmedia.columnSpacing}
				borderWidth = {$styles.content.textmedia.borderWidth}
				borderPadding = {$styles.content.textmedia.borderPadding}
	            defaultImgWidthBig = {$bootstrap.image.default.width.big}
	            defaultImgWidthSmall = {$bootstrap.image.default.width.small}
			}

		}
	}

}
