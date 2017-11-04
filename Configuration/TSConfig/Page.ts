#-------------------------------------------------------------------------------
#	Include
#-------------------------------------------------------------------------------
<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3sbootstrap/Configuration/TSConfig/NewContentElements.ts">
<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3sbootstrap/Configuration/TSConfig/Gridelements.ts">
<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3sbootstrap/Configuration/TSConfig/SysFileReference.ts">

#-------------------------------------------------------------------------------
#	Content
#-------------------------------------------------------------------------------
TCEFORM.tt_content {
	linkToTop.disabled = 1
	table_class.disabled = 1
	space_before_class.disabled = 1
	space_after_class.disabled = 1

	date {
		types {
			t3sbs_button.disabled = 1
			t3sbs_mediaobject.disabled = 1
			t3sbs_card.disabled = 1
		}
	}

	pi_flexform {
		types {
			gridelements_pi1.disabled = 1
		}
	}


	header {
		types {
			t3sbs_button {
				label.default = Button Text
				label.de = Button Text
			}
			t3sbs_card {
				label.default = Card Title
				label.de = Card Titel
			}
		}
	}

	header_link {
		types {
			t3sbs_button {
				label.default = Button Link
				label.de = Button Link
			}
			t3sbs_card {
				label.default = Link (new button)
				label.de = Link (neuer Button)
			}
		}
	}

	header_layout {
		types {
			t3sbs_button.disabled = 1
			t3sbs_mediaobject.disabled = 1
			t3sbs_card.disabled = 1
		}
	}

	tx_t3sbootstrap_header_display {
		types {
			t3sbs_button.disabled = 1
			t3sbs_mediaobject.disabled = 1
			t3sbs_card.disabled = 1
		}
	}

	header_position {
		types {
			t3sbs_button {
				label.default = Button Alignment
				label.de = Button Ausrichtung
			}
			t3sbs_card {
				label.default = Card Alignment
				label.de = Card Ausrichtung
			}
			t3sbs_mediaobject.disabled = 1
			t3sbs_carousel.disabled = 1

		}
	}

	subheader {
		types {
			t3sbs_button.disabled = 1
			t3sbs_mediaobject.disabled = 1
			t3sbs_card {
				label.default = Card subtitle
				label.de = Card Untertitel
			}
		}
	}

	imageorient.addItems.66 = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:tt_content.imageorient.66
	imageorient.addItems.77 = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:tt_content.imageorient.77
	imageorient {
		#0 = Above, center
		#1 = Above, right
		#2 = Above, left
		#8 = Below, center
		#9 = Below, right
		#10 = Below, left
		#17 = In text, right
		#18 = In text, left
		#25 = In text, right (nowrap)
		#26 = In text, left (nowrap)
		types {
			t3sbs_card {
				removeItems = 1,2,9,10,17,18,25,26,66,77
				label.default = Image position
				label.de = Bild Position
				altLabels.0 = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:tsconfig.card.img.above
				altLabels.8 = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:tsconfig.card.img.below
			}
			t3sbs_mediaobject {
				removeItems = 0,1,2,8,9,10,17,18,25,26,66,77
				label.default = Image position
				label.de = Bild Position
				addItems.90 = Default
				addItems.91 = Center-aligned media
				addItems.92 = Top-aligned media
				addItems.93 = Bottom-aligned media
			}
			t3sbs_carousel.disabled = 1
		}
	}

	imagecols {
		types {
			t3sbs_card.disabled = 1
			t3sbs_mediaobject.disabled = 1
			t3sbs_carousel.disabled = 1
		}
	}

	imagewidth {
		types {
			t3sbs_carousel.disabled = 1
		}
	}
	imageheight {
		types {
			t3sbs_carousel.disabled = 1
		}
	}
	imageborder {
		types {
			t3sbs_carousel.disabled = 1
		}
	}
	image_zoom {
		types {
			t3sbs_carousel.disabled = 1
		}
	}


	tx_t3sbootstrap_header_class {
		types {
			t3sbs_button.disabled = 1
			t3sbs_mediaobject.disabled = 1
		}
	}

	tx_t3sbootstrap_bgcolor {
		types {
			t3sbs_button.disabled = 1
			t3sbs_carousel.disabled = 1
		}
	}

	tx_t3sbootstrap_contextcolor {
		types {
			t3sbs_button.disabled = 1
			t3sbs_carousel.disabled = 1
		}
	}

	tx_t3sbootstrap_textcolor {
		types {
			t3sbs_button.disabled = 1
			t3sbs_carousel.disabled = 1
		}
	}

	tx_t3sbootstrap_padding_sides {
		types {
			t3sbs_carousel.disabled = 1
		}
	}
	tx_t3sbootstrap_padding_size {
		types {
			t3sbs_carousel.disabled = 1
		}
	}
	tx_t3sbootstrap_margin_sides {
		types {
			t3sbs_carousel.disabled = 1
		}
	}
	tx_t3sbootstrap_margin_size {
		types {
			t3sbs_carousel.disabled = 1
		}
	}
	tx_t3sbootstrap_container {
		types {
			t3sbs_carousel.disabled = 1
		}
	}
	tx_t3sbootstrap_extra_class {
		types {
			t3sbs_carousel.disabled = 1
		}
	}
	tx_t3sbootstrap_flexform {
		types {
			t3sbs_carousel.disabled = 1
		}
	}
}

