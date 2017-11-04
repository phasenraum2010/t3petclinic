# Dynamic content
lib.dynamicContent = COA
lib.dynamicContent {
	5 = LOAD_REGISTER
	5 {
		colPos.cObject = TEXT
		colPos.cObject {
			field = colPos
			ifEmpty.cObject = TEXT
			ifEmpty.cObject {
				value.current = 1
				ifEmpty = 0
			}
		}
		pageUid.cObject = TEXT
		pageUid.cObject {
			field = pageUid
			ifEmpty.data = TSFE:id
		}
	}
	10 = CONTENT
	10 {
		table = tt_content
		select {
			includeRecordsWithoutDefaultTranslation = 1
			orderBy = sorting
			where = colPos={register:colPos}
			where.insertData = 1
			pidInList.data = register:pageUid
		}
	}
	90 = RESTORE_REGISTER
}

# use for content slide
#lib.dynamicContentSlide =< lib.dynamicContent
#lib.dynamicContentSlide.10.slide = -1

# footer content
lib.content.footerFromPid = CONTENT
lib.content.footerFromPid {
	table = tt_content
	select {
		orderBy = sorting
		where = colPos= 0
		pidInList.data = register:footerpid
	}
}

# if indexed_search is loaded
[userFunc = TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('indexed_search')]
lib.dynamicContent.10.wrap = <!--TYPO3SEARCH_begin-->|<!--TYPO3SEARCH_end-->
[global]
