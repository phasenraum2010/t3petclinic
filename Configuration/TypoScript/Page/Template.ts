
page {
	# Page template
	10 = FLUIDTEMPLATE
	10 {
		file = EXT:t3sbootstrap/Resources/Private/Templates/Main.html

		partialRootPaths >
		partialRootPaths {
			0 = EXT:fluid_styled_content/Resources/Private/Partials/
			1 = EXT:t3sbootstrap/Resources/Private/Partials/
			2 = EXT:t3sbootstrap/Resources/Private/Partials/Content/
			3 = {$plugin.tx_t3sbootstrap.view.partialRootPath}
			4 = {$plugin.tx_t3sbootstrap.view.partialRootPath}Content/
			10 = {$styles.templates.partialRootPath}
		}
		layoutRootPaths >
		layoutRootPaths {
			0 = EXT:fluid_styled_content/Resources/Private/Layouts/
			1 = EXT:t3sbootstrap/Resources/Private/Layouts/
			2 = EXT:t3sbootstrap/Resources/Private/Layouts/Content/
			3 = {$plugin.tx_t3sbootstrap.view.layoutRootPath}
			4 = {$plugin.tx_t3sbootstrap.view.layoutRootPath}Content/
			10 = {$styles.templates.layoutRootPath}
		}
		variables {
			be_layout = TEXT
			be_layout.value < temp.pagelayout
		}
		settings	{
			navbar {
				image.defaultPath = {$bootstrap.navbar.image.defaultPath}
				image.width = {$bootstrap.navbar.image.width}
				image.height = {$bootstrap.navbar.image.height}
			}
			indexedsearch.targetPid = {$plugin.tx_indexedsearch.settings.targetPid}
			configOverride = {$bootstrap.extconf.configOverride}
			expandedContent = {$bootstrap.extconf.expandedContent}
			date.format = {$bootstrap.config.dateFormat}
			lastModifiedContentElement = {$bootstrap.config.lastModifiedContentElement}

		}
		dataProcessing {
			#
			# NavBar / Main Navigation
			#
			#  MenuProcessor: expand allowed configuration keys: "levels. & includeSpacer."
			10 = T3SBS\T3sbootstrap\DataProcessing\MenuProcessor
			10 {
				entryLevel.cObject = TEXT
				entryLevel.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:navbar_entrylevel
				levels.cObject = TEXT
				levels.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:navbar_levels
				levels.cObject.stdWrap.override = {$bootstrap.config.navbar_levels}
				levels.cObject.stdWrap.override.if.isTrue = {$bootstrap.config.navbar_levels}
				excludeUidList.cObject = TEXT
				excludeUidList.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:navbar_excludeuiduist
				excludeUidList.cObject.stdWrap.override = {$bootstrap.config.navbar_excludeuiduist}
				excludeUidList.cObject.stdWrap.override.if.isTrue = {$bootstrap.config.navbar_excludeuiduist}
				includeSpacer.cObject = TEXT
				includeSpacer.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:navbar_includespacer
				includeSpacer.cObject.stdWrap.override = {$bootstrap.config.navbar_includespacer}
				includeSpacer.cObject.stdWrap.override.if.isTrue = {$bootstrap.config.navbar_includespacer}
				as = navbarMenu
			}
			#
			# Sub Navigation in Sidebar
			#
			20 = T3SBS\T3sbootstrap\DataProcessing\MenuProcessor
			20 {
				entryLevel.data = page:pid
				levels.cObject = TEXT
				levels.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:sidebar_levels
				levels.cObject.stdWrap.override = {$bootstrap.config.sidebar_levels}
				levels.cObject.stdWrap.override.if.isTrue = {$bootstrap.config.sidebar_levels}
				excludeUidList.cObject = TEXT
				excludeUidList.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:sidebar_excludeuiduist
				excludeUidList.cObject.stdWrap.override = {$bootstrap.config.sidebar_excludeuiduist}
				excludeUidList.cObject.stdWrap.override.if.isTrue = {$bootstrap.config.sidebar_excludeuiduist}
				includeSpacer.cObject = TEXT
				includeSpacer.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:sidebar_includespacer
				includeSpacer.cObject.stdWrap.override = {$bootstrap.config.sidebar_includespacer}
				includeSpacer.cObject.stdWrap.override.if.isTrue = {$bootstrap.config.sidebar_includespacer}
				as = subNavigation
				if {
					isTrue.cObject = COA
					isTrue.cObject {
						10 = TEXT
						10.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:sidebar_enable
						20 = TEXT
						20.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:sidebar_rightenable
						30 = TEXT
						30.value = {$bootstrap.config.sidebar_enable}
						40 = TEXT
						40.value = {$bootstrap.config.sidebar_rightenable}
					}
				}
			}
			#
			# Breadcrumb
			#
			30 = TYPO3\CMS\Frontend\DataProcessing\MenuProcessor
			30 {
				special = rootline
				special.range = 0|-1
				as = breadcrumb
			}
 			#
			# Language Navigation
			#
			40 = TYPO3\CMS\Frontend\DataProcessing\MenuProcessor
			40 {
				special = language
				special.value.cObject = TEXT
				special.value.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:navbar_lang_uid
				special.value.cObject.stdWrap.override = {$bootstrap.config.navbar_lang_uid}
				special.value.cObject.stdWrap.override.if.isTrue = {$bootstrap.config.navbar_lang_uid}
				as = languageNavigation
				if {
					isTrue.cObject = COA
					isTrue.cObject {
						10 = TEXT
						10.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:navbar_lang_uid
						20 = TEXT
						20.value = {$bootstrap.config.navbar_lang_uid}
					}
				}
			}
			#
			# Meta Navigation
			#
			50 = TYPO3\CMS\Frontend\DataProcessing\MenuProcessor
			50 {
				special = list
				special.value.cObject = TEXT
				special.value.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:meta_value
				special.value.cObject.stdWrap.override = {$bootstrap.config.meta_value}
				special.value.cObject.stdWrap.override.if.isTrue = {$bootstrap.config.meta_value}
				levels = 1
				as = metaNavigation
				if {
					isTrue.cObject = COA
					isTrue.cObject {
						10 = TEXT
						10.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:meta_enable
						20 = TEXT
						20.value = {$bootstrap.config.meta_enable}
					}
				}
			}
			#
			# Section Menu
			#
			60 = T3SBS\T3sbootstrap\DataProcessing\MenuProcessor
			60 {
				special = list
				special {
					value {
						field = pages
						override {
							data = page:uid
							if {
								isFalse.field = pages
							}
						}
					}
				}
				as = sectionMenu
				dataProcessing {
					10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
					10 {
						references.fieldName = media
					}
					20 = TYPO3\CMS\Frontend\DataProcessing\DatabaseQueryProcessor
					20 {
						table = tt_content
						pidInList.field = uid
						orderBy = sorting
						as = content
						where = sectionIndex = 1
						dataProcessing {
							10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
							10 {
								references.fieldName = image
							}
						}
					}
				}
				if {
					isTrue.cObject = COA
					isTrue.cObject {
						10 = TEXT
						10.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:navbar_sectionmenu
						20 = TEXT
						20.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:sidebar_rightenable
						30 = TEXT
						30.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:sidebar_enable
						40 = TEXT
						40.value = {$bootstrap.config.navbar_sectionmenu}
						50 = TEXT
						50.value = {$bootstrap.config.sidebar_rightenable}
						60 = TEXT
						60.value = {$bootstrap.config.sidebar_enable}
					}
				}
			}
			#
			# Date of the last modified content element on current page
			#
			70 = T3SBS\T3sbootstrap\DataProcessing\LastModifiedProcessor


			#
			# Main Config
			#
			90 = T3SBS\T3sbootstrap\DataProcessing\ConfigProcessor
			90 {
				rootline = {$bootstrap.config.rootline}
				dataProcessing {
					10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
					10 {
						references {
							table = pages
							fieldName = media
						}
						as = pagemedia
					}
				}
			}
		}
	}
}

