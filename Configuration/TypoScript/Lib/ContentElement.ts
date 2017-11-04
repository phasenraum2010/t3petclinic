#-------------------------------------------------------------------------------
#	FluidContent - configuration
#-------------------------------------------------------------------------------
lib.contentElement {
	templateRootPaths >
	templateRootPaths {
		0 = EXT:fluid_styled_content/Resources/Private/Templates/
		1 = EXT:t3sbootstrap/Resources/Private/Templates/
		2 = EXT:t3sbootstrap/Resources/Private/Templates/Content/
		3 = {$plugin.tx_t3sbootstrap.view.templateRootPath}
		4 = {$plugin.tx_t3sbootstrap.view.templateRootPath}Content/
		10 = {$styles.templates.templateRootPath}
	}
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
		10 = {$styles.templates.layoutRootPath}
	}
	settings {
		media {
			popup {
				bodyTag >
				wrap = |
				width = {$styles.content.textmedia.linkWrap.width}
				height = {$styles.content.textmedia.linkWrap.height}
				JSwindow = 0
				directImageLink = 1
				linkParams.ATagParams.dataWrap >
				linkParams.ATagParams.stdWrap.cObject = COA
				linkParams.ATagParams.stdWrap.cObject {
					98 = TEXT
					98.data = file:current:description // file:current:title
					98.stdWrap.htmlSpecialChars = 1
					98.wrap = data-caption="|"
					98.required	= 1
					99 = TEXT
					99.data = file:current:title
					99.stdWrap.htmlSpecialChars = 1
					99.wrap = title="|"
					99.required	= 1
				}
			}
		}
	}
	variables {
		be_layout = TEXT
		be_layout.value < temp.pagelayout
	}
	dataProcessing {
		224 = T3SBS\T3sbootstrap\DataProcessing\BootstrapProcessor
		224 {
			container = {$bootstrap.extconf.container}
			cType = {$bootstrap.extconf.cTypeClass}
			sectionmenu = TEXT
			sectionmenu.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:navbar_sectionmenu
			sidebarleft = TEXT
			sidebarleft.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:sidebar_enable
			sidebarright = TEXT
			sidebarright.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:sidebar_rightenable
		}
	}
}

