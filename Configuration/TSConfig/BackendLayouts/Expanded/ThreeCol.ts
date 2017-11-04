mod {
	web_layout {
		BackendLayouts {
			ThreeCol {
				title = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:backend_layout.threeCol
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
										name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:backend_layout.sidebar-left
										colspan = 1
										colPos = 1
									}
									2 {
										name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:backend_layout.content
										colspan = 1
										colPos = 0
									}
									3 {
										name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:backend_layout.sidebar-right
										colspan = 1
										colPos = 2
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
				icon = EXT:t3sbootstrap/Resources/Public/Icons/Layouts/layout-3_col-3-6-3.svg
			}
		}
	}
}

