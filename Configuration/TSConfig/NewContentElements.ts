#-------------------------------------------------------------------------------
#	New Content Element Wizard
#-------------------------------------------------------------------------------
mod.wizards {
	newContentElement {
		wizardItems {
			common.elements {
				textmedia.tt_content_defValues.imageorient = 25
			}
			t3sbs {
				header = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:t3sbs_contentelements
				elements {
					t3sbsmediaobject {
						iconIdentifier = content-textpic
						title = BS Media object
						description = The media object helps build complex and repetitive components where some media is positioned alongside content that doesn’t wrap around said media.
						tt_content_defValues.CType = t3sbs_mediaobject
					}
					t3sbscard {
						iconIdentifier = content-beside-text-img-above-center
						title = BS Card
						description = A card is a flexible and extensible content container.
						tt_content_defValues.CType = t3sbs_card
					}
					t3sbscarousel {
						iconIdentifier = bs-carousel
						title = BS Carousel
						description = A slideshow component for cycling through elements—images or slides of text—like a carousel.
						tt_content_defValues.CType = t3sbs_carousel
					}
					t3sbutton {
						iconIdentifier = bs-button
						title = BS Button
						description = Bootstrap includes several predefined button styles, each serving its own semantic purpose.
						tt_content_defValues.CType = t3sbs_button
					}

				}
				show := addToList(t3sbsmediaobject,t3sbscard,t3sbscarousel,t3sbutton)
			}
		}
	}
}
