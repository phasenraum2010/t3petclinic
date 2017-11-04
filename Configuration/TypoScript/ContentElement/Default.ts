# ===============================================================================
# tt_content configuration
# ===============================================================================
tt_content {

	# **********************************************************
	# Textmedia
	# **********************************************************
	textmedia {
		dataProcessing {
			20 >
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

	# **********************************************************
	# Textpic
	# **********************************************************
	textpic {
		dataProcessing {
			20 >
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

	# **********************************************************
	# Image
	# **********************************************************
	image {
		dataProcessing {
			20 >
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


	# **********************************************************
	# Bullet List
	# **********************************************************
	bullets {
		dataProcessing {
			10.if.value = 5
			20.if.value = 5
		}
	}
	

}
