
page {
	bodyTagCObject = COA
	bodyTagCObject {
		wrap = <body |>
		10 = TEXT
		10.data = TSFE:id
		10.noTrimWrap = | id="page-|"|
		20 = COA
		20 {
			stdWrap.noTrimWrap = | class="|"|
			10 = TEXT
			10 {
				noTrimWrap = |||
				value < temp.pagelayout
				value.case = lower
			}
			20 = TEXT
			20 {
				data = page:layout
				noTrimWrap = | layout-||
				if.isTrue.data = page:layout
			}
		}

		30 = COA
		30 {
			stdWrap.noTrimWrap = | style="|"|
			10 = TEXT
			10.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:navbar_height
			10.wrap = padding-top:|px;
			if {
				isTrue.cObject = TEXT
				isTrue.cObject.data.dataWrap = DB:tx_t3sbootstrap_domain_model_config:{register:configuid}:navbar_height
			}
		}
	}
}
