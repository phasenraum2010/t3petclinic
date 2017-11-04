
page {
	1 = LOAD_REGISTER
	1.homepageuid.cObject = TEXT
	1.homepageuid.cObject.data = LEVELFIELD:0,uid,slide
	1.homepageuid.intval = 1

	1.currentuid.cObject  = CONTENT
	1.currentuid.cObject {
		table = tx_t3sbootstrap_domain_model_config
		select.pidInList.data = page:uid
		renderObj = TEXT
		renderObj.field = uid
		slide = -1
		slide.if.isTrue = {$bootstrap.config.rootline}
	}
	1.currentuid.intval = 1

	1.configuid.cObject = COA
	1.configuid.cObject {
		10 = TEXT
		10 {
			data = register:homepageuid
			if.isFalse.data = register:currentuid
		}
		20 = TEXT
		20 {
			data = register:currentuid
			if.isTrue.data = register:currentuid
		}
	}
	1.configuid.intval = 1

	1.breakpoint.cObject = TEXT
	1.breakpoint.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:navbar_breakpoint

	1.footerpid.cObject = TEXT
	1.footerpid.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:footer_pid
	1.footerpid.intval = 1
}

/*
page.20 = COA
page.20 {
	10 = TEXT
	10.data = debug:register
#	20 = TEXT
#	20.data = debug:page
}
*/
