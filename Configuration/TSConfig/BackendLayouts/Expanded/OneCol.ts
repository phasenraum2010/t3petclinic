mod {
	web_layout {
		BackendLayouts {
			OneCol {
				title = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:backend_layout.oneCol
				config {
					backend_layout {
						colCount = 1
						rowCount = 5
						rows {
							1 {
								columns {
									1 {
										name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:backend_layout.otc
										colPos = 20
									}
								}
							}
							2 {
								columns {
									1 {
										name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:backend_layout.jumbotron
										colPos = 3
									}
								}
							}
							3 {
								columns {
									1 {
										name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:backend_layout.content
										colPos = 0
									}
								}
							}
							4 {
								columns {
									1 {
										name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:backend_layout.footer
										colPos = 4
									}
								}
							}
							5 {
								columns {
									1 {
										name = LLL:EXT:t3sbootstrap/Resources/Private/Language/locallang_be.xlf:backend_layout.obc
										colPos = 21
									}
								}
							}
						}
					}
				}
				icon = EXT:t3sbootstrap/Resources/Public/Icons/Layouts/layout-1_col.svg
			}
		}
	}
}
