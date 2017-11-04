# **********************************************************
# General configuration of a page
# **********************************************************
page = PAGE
page {
	meta {
		viewport = width=device-width, initial-scale=1, shrink-to-fit=no
	}
}

config {
	doctype = html5
	disablePrefixComment = {$bootstrap.config.disablePrefixComment}

	compressJs = {$bootstrap.config.compress}
	compressCss = {$bootstrap.config.compress}
	concatenateJs = {$bootstrap.config.compress}
	concatenateCss = {$bootstrap.config.compress}

}

# **********************************************************
# Multilanguage configuration
# **********************************************************

# Default language - here German
config {
	sys_language_uid = 0
	language = de
	locale_all = de_DE.UTF-8
	htmlTag_langKey = de
	sys_language_mode = default
	sys_language_overlay = 0
}

# English
[globalVar = GP:L = 1]
	config {
		sys_language_uid = 1
		language = en
		locale_all = en_UK.UTF-8
		htmlTag_langKey = en
	}
[global]

# disable in EM config if using an SEO extension like metaseo or cs_seo
[globalVar = LIT:1 = {$bootstrap.extconf.metatags}]
page {
	meta {
		description.data = levelfield :-1, description, slide
		description.override.field = description
		keywords.data = levelfield :-1, keywords, slide
		keywords.override.field = keywords

		revisit-after = {$bootstrap.config.revisitAfter}
		robots = {$bootstrap.config.robots}
	}
}
config {
	titleTagFunction = T3SBS\T3sbootstrap\Utility\TitleTag->get
	titleTagFunction.data = page:nav_title // page:title
}
[global]
