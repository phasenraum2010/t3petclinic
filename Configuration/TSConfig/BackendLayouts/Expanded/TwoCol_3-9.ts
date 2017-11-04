mod {
	web_layout {
		BackendLayouts {
			TwoCol_3-9 {
				title = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:backend_layout.twoCol_3-9
				config {
					backend_layout {
						colCount = 3
						rowCount = 5
						rows {
							1 {
								columns {
									1 {
										name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:backend_layout.otc
										colspan = 3
										colPos = 20
									}
								}
							}
							2 {
								columns {
									1 {
										name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:backend_layout.jumbotron
										colspan = 3
										colPos = 3
									}
								}
							}
							3 {
								columns {
									1 {
										name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:backend_layout.sidebar
										colspan = 1
										colPos = 1
									}
									2 {
										name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:backend_layout.content
										colspan = 2
										colPos = 0
									}
								}
							}
							4 {
								columns {
									1 {
										name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:backend_layout.footer
										colspan = 3
										colPos = 4
									}
								}
							}
							5 {
								columns {
									1 {
										name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:backend_layout.obc
										colspan = 3
										colPos = 21
									}
								}
							}
						}
					}
				}
				icon = EXT:t3sbootstrap/Resources/Public/Icons/Layouts/layout-2_col-3-9.svg
			}
		}
	}
}
