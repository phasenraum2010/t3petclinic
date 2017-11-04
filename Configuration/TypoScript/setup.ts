# Module configuration
module.tx_t3sbootstrap {
	view {
		templateRootPaths.0 = EXT:t3sbootstrap/Resources/Private/Backend/Templates/
		partialRootPaths.0 = EXT:t3sbootstrap/Resources/Private/Backend/Partials/
		layoutRootPaths.0 = EXT:t3sbootstrap/Resources/Private/Backend/Layouts/
	}
	settings {
		t3sbConfig {
			rootline = {$bootstrap.config.rootline}
		}

		customScss = {$bootstrap.extconf.customScss}
		customScssPath = {$bootstrap.extconf.customScssPath}

		indexedsearch = {$bootstrap.ext.indexedsearch}

		modalform = {$bootstrap.form.modal}

		info.megamenu = {$bootstrap.info.megamenu}
	}
}

plugin.tx_felogin_pi1._CSS_DEFAULT_STYLE >

temp.pagelayout {
	data = pagelayout
	required = 1
	split {
		token = pagets__
		cObjNum = 1
		1.current = 1
	}
}

<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3sbootstrap/Configuration/TypoScript/Page/_main.ts">
<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3sbootstrap/Configuration/TypoScript/Lib/_main.ts">
<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3sbootstrap/Configuration/TypoScript/Content/_main.ts">
<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3sbootstrap/Configuration/TypoScript/ContentElement/_main.ts">



