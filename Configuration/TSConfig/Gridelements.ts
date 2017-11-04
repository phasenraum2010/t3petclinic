### frame: 1=red, 2=green, 3=blue


# **********************************************************
# BOOTSTAP: Grid system
# **********************************************************
# 2 columns
tx_gridelements.setup.two_columns {
  	title = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.twoColumns.title
	description = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.twoColumns.description
	frame = 2
	iconIdentifier = ge-2_col
	topLevelLayout = 0
	config {
		colCount = 2
		rowCount = 1
		rows {
			1 {
				columns {
					1 {
						name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.anyColumns.colPos.0
						colPos = 0
					}
					2 {
						name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.anyColumns.colPos.1
						colPos = 1
					}
				}
			}
		}
	}
}
# 3 columns
tx_gridelements.setup.three_columns {
  	title = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.threeColumns.title
	description = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.threeColumns.description
	frame = 2
	iconIdentifier = ge-3_col
	topLevelLayout = 0
	config {
		colCount = 3
		rowCount = 1
		rows {
			1 {
				columns {
					1 {
						name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.anyColumns.colPos.0
						colPos = 0
					}
					2 {
						name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.anyColumns.colPos.1
						colPos = 1
					}
					3 {
						name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.anyColumns.colPos.2
						colPos = 2
					}
				}
			}
		}
	}
}
# 4 columns
tx_gridelements.setup.four_columns {
  	title = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.fourColumns.title
	description = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.fourColumns.description
	frame = 2
	iconIdentifier = ge-4_col
	topLevelLayout = 0
	config {
		colCount = 4
		rowCount = 1
		rows {
			1 {
				columns {
					1 {
						name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.anyColumns.colPos.0
						colPos = 0
					}
					2 {
						name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.anyColumns.colPos.1
						colPos = 1
					}
					3 {
						name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.anyColumns.colPos.2
						colPos = 2
					}
					4 {
						name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.anyColumns.colPos.3
						colPos = 3
					}
				}
			}
		}
	}
}

# **********************************************************
# BOOTSTAP: Card wrapper
# **********************************************************
tx_gridelements.setup.card_wrapper {
  	title = Card Wrapper
	description = description
	frame = 2
	iconIdentifier = ge-card-container
	topLevelLayout = 0
	config {
		colCount = 1
		rowCount = 1
		rows {
			1 {
				columns {
					1 {
						name = Card Wrapper
						colPos = 0
						allowed = t3sbs_card
					}
				}
			}
		}
	}
}

# **********************************************************
# BOOTSTAP: Button group
# **********************************************************
tx_gridelements.setup.button_group {
	title = Button group
	description = Group a series of buttons together on a single line with the button group.
	frame = 1
	iconIdentifier = buttongroup
	topLevelLayout = 0
	config {
		colCount = 1
		rowCount = 1
		rows {
			1 {
				columns {
					1 {
						name = Button group
						colPos = 0
						allowed = t3sbs_button
					}
				}
			}
		}
	}
}


# **********************************************************
# BOOTSTAP: Full width container with background color or - image
# **********************************************************
tx_gridelements.setup.background_wrapper {
	title = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.backgroundWrapper.title
	description = Full width container with background color or - image
	frame = 1
	iconIdentifier = ge-background_wrapper
	config {
		colCount = 1
		rowCount = 1
		rows {
			1 {
				columns {
					1 {
						name = Full width container with background-color and -image
						colPos = 0
					}
				}
			}
		}
	}
}



# **********************************************************
# BOOTSTAP: Full width container with parallax image scroll
# **********************************************************
tx_gridelements.setup.parallax_wrapper {
	title = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.parallaxWrapper.title
	description = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.parallaxWrapper.description
	frame = 1
	iconIdentifier = ge-parallax_wrapper
	config {
		colCount = 1
		rowCount = 1
		rows {
			1 {
				columns {
					1 {
						name = Full width container with parallax image scroll
						colPos = 0
					}
				}
			}
		}
	}
}



# **********************************************************
# BOOTSTAP: Auto-Layout
# **********************************************************
tx_gridelements.setup.autoLayout_row {
	title = Auto-layout
	description = Options: "Equal-width", "Setting one column width" or "Variable width content".
	frame = 1
	iconIdentifier = ge-card-container
	topLevelLayout = 0
	config {
		colCount = 1
		rowCount = 1
		rows {
			1 {
				columns {
					1 {
						name = Auto-layout row for ...
						colPos = 0
					}
				}
			}
		}
	}
}

# **********************************************************
# BOOTSTAP: Container
# **********************************************************
tx_gridelements.setup.container {
	title = Container
	description = Bootstrap .container
	frame = 1
	iconIdentifier = ge-card-container
	topLevelLayout = 0
	config {
		colCount = 1
		rowCount = 1
		rows {
			1 {
				columns {
					1 {
						name = Container
						colPos = 0
					}
				}
			}
		}
	}
}


# **********************************************************
# BOOTSTAP: Carousel
# **********************************************************
tx_gridelements.setup.carousel_container {
	title = Carousel Container
	description = A container for several Carousel slides (CE:t3sb_carousel) (red frame)
	frame = 1
	iconIdentifier = ge-carousel-container
	topLevelLayout = 0
	config {
		colCount = 1
		rowCount = 1
		rows {
			1 {
				columns {
					1 {
						name = Carousel Container
						colPos = 0
						allowed = t3sbs_carousel
					}
				}
			}
		}
	}
}


# **********************************************************
# BOOTSTAP: Collapse
# **********************************************************
# Collapsible Container
tx_gridelements.setup.collapsible_container {
	title = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.collapsibleContainer.title
	description = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.collapsibleContainer.description
	iconIdentifier = ge-accordion-container
	frame = 3
	config {
		colCount = 1
		rowCount = 1
		rows {
			1 {
				columns {
					1 {
						name = Collapsible Container
						colPos = 0
						allowed = gridelements_pi1
						allowedGridTypes = collapsible_accordion
					}
				}
			}
		}
	}
}
# Collapsible Element
tx_gridelements.setup.collapsible_accordion {
	title = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.collapsibleElement.title
	description = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.collapsibleElement.description
	iconIdentifier = ge-accordion-element
	frame = 2
	config {
		colCount = 1
		rowCount = 1
		rows {
			1 {
				columns {
					1 {
						name = Collapsible Element
						colPos = 0
					}
				}
			}
		}
	}
}


# **********************************************************
# BOOTSTAP: Modal
# **********************************************************
tx_gridelements.setup.modal {
	title = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.modal.title
	description = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:gridelement.modal.description
	frame = 3
	iconIdentifier = ge-modal
	config {
		colCount = 1
		rowCount = 1
		rows {
			1 {
				columns {
					1 {
						name = Modal
						colPos = 0
					}
				}
			}
		}
	}
}