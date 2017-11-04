<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

call_user_func(
	function($extKey, $extconf)
	{
		/***************
		 * Extension configuration
		 */
		if ( $extconf ) {
			$extconf = unserialize($extconf);
		} else {
			// default setting
			$extconf = [
				'container' => 1,
				'spacing' => 1,
				'color' => 1,
				'codesnippet' => 0,
				'cTypeClass' => 0,
				'customScss' => 0,
				'customScssPath' => 'uploads/tx_t3sbootstrap/',
				'expandedContent' => 0,
				'configOverride' => 0,
				'metatags' => 1
			];
		}

		/***************
		 * TsConfig
		 */
		 # Page TSconfig
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3sbootstrap/Configuration/TSConfig/Page.ts">');

		/***************
		 * CKEditor
		 */
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3sbootstrap/Configuration/TSConfig/CKEditor.ts">');

		// Optional CKEditor plugin "Code Snippet"
		if (array_key_exists('codesnippet', $extconf) && $extconf['codesnippet'] === '1') {
			# if  rte_ckeditor_fontawesome is loaded
			if ( \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('rte_ckeditor_fontawesome') ) {
				$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['t3sbootstrap'] = 'EXT:t3sbootstrap/Configuration/RTE/CodesnippetFa.yaml';
			} else {
				$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['t3sbootstrap'] = 'EXT:t3sbootstrap/Configuration/RTE/Codesnippet.yaml';
			}
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.codesnippet = 1');
		} else {
			# if  rte_ckeditor_fontawesome is loaded
			if ( \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('rte_ckeditor_fontawesome') ) {
				$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['t3sbootstrap'] = 'EXT:t3sbootstrap/Configuration/RTE/DefaultFa.yaml';
			} else {
				$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['t3sbootstrap'] = 'EXT:t3sbootstrap/Configuration/RTE/Default.yaml';
			}
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.codesnippet = 0');
		}

		/***************
		 * Register Icons
		 */
		if (TYPO3_MODE === 'BE') {
			$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
			$icons = ['bs-card', 'bs-button', 'bs-carousel', 'ge-2_col', 'ge-3_col', 'ge-4_col', 'ge-card-container', 'ge-background_wrapper', 'ge-parallax_wrapper', 'ge-carousel-container', 'ge-accordion-container', 'ge-accordion-element', 'ge-modal'];
			foreach ($icons as $icon) {
				$iconRegistry->registerIcon(
					$icon,
					\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
					['source' => 'EXT:t3sbootstrap/Resources/Public/Icons/Register/'.$icon.'.svg']
				);
			}
			// FontawesomeIconProvider
			$iconRegistry->registerIcon(
				'buttongroup',
				\TYPO3\CMS\Core\Imaging\IconProvider\FontawesomeIconProvider::class,
				['name' => 'bars']
			);

			unset($iconRegistry);
		}

		// Optional select-field for a .container or .container-fluid class in any content element
		if (array_key_exists('container', $extconf) && $extconf['container'] === '1') {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.container = 1');
		} else {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.container = 0');
		}
		// Optional select-fields for margin and padding in any content element
		if (array_key_exists('spacing', $extconf) && $extconf['spacing'] === '1') {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.spacing = 1');
		} else {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.spacing = 0');
		}
		// Optional "Bootstrap color palette"
		if (array_key_exists('color', $extconf) && $extconf['color'] === '1') {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.color = 1');
		} else {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.color = 0');
		}
		// Optional "cType in class"
		if (array_key_exists('cTypeClass', $extconf) && $extconf['cTypeClass'] === '1') {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.cTypeClass = 1');
		} else {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.cTypeClass = 0');
		}


		// Optional "custom scss"
		if (array_key_exists('customScss', $extconf) && $extconf['customScss'] === '1') {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.customScss = 1');
			# declaring the task to write a custom scss file
			$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['T3SBS\T3sbootstrap\Tasks\Scss'] = [
			   'extension' => $extKey,
			   'title' => 'T3SB Custom Scss - write a custom scss file',
			   'description' => 'T3SB Custom Scss - write a custom scss file',
			];
		} else {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.customScss = 0');
		}
		// Optional "custom scss path"
		if (array_key_exists('customScssPath', $extconf)) {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.customScssPath = '.$extconf['customScssPath']);
		} else {
			#\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.customScssPath = 0');
		}
		// Optional "expanded content"
		if (array_key_exists('expandedContent', $extconf) && $extconf['expandedContent'] === '1') {
			# expanded content on top and bottom
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3sbootstrap/Configuration/TSConfig/BackendLayouts/Expanded/_main.ts">');
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.expandedContent = 1');
		} else {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3sbootstrap/Configuration/TSConfig/BackendLayouts/Default/_main.ts">');
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.expandedContent = 0');
		}
		// Optional "config override"
		if (array_key_exists('configOverride', $extconf) && $extconf['configOverride'] === '1') {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.configOverride = 1');
		} else {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.configOverride = 0');
		}
		// Optional "metatags"
		if (array_key_exists('metatags', $extconf) && $extconf['metatags'] === '1') {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.metatags = 1');
		} else {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.extconf.metatags = 0');
		}


		# if indexed_search is loaded
		if ( \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('indexed_search') ) {
			 # Setup
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript($extKey,
				'setup','<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3sbootstrap/Resources/Private/Extensions/IndexedSearch/Setup.ts">',
				defaultContentRendering
			);
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.ext.indexedsearch = 1');
		} else {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.ext.indexedsearch = 0');
		}

		# if form is loaded ...
		if ( \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('form') ) {
			# & if typoscript_rendering is loaded
			if ( \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('typoscript_rendering') ) {
				# declaring the task to write some files to "fileadmin/T3SBForm/"
				$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['T3SBS\T3sbootstrap\Tasks\Form'] = [
				   'extension' => $extKey,
				   'title' => 'T3SB Form (ajax) - write files to "fileadmin/T3SBForm/"',
				   'description' => 'Write yaml-files and a html-template to "fileadmin/T3SBForm/"',
				];
				$customTemplatePath = 'fileadmin/T3SBForm/Templates/';
				$customTemplateFilePath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($customTemplatePath);
				$customTemplateFileName = 'Form.html';
				if (file_exists($customTemplateFilePath.$customTemplateFileName)) {
					 # Setup
					\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript($extKey,
						'setup','<INCLUDE_TYPOSCRIPT: source="FILE:EXT:t3sbootstrap/Resources/Private/Extensions/Form/Setup.ts">',
						defaultContentRendering
					);
					$success = '<p class="text-center my-3">Vielen Dank für Ihre Anfrage, ich werde mich umgehend mit Ihnen in Verbindung setzen!</p>';
					\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.ext.form.success = '.$success);
					\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.ext.form.ajax = 1');
				} else {
					\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.ext.form.ajax = 0');
				}
			} else {
				\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.ext.form.ajax = 0');
			}
		} else {
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('bootstrap.ext.form.ajax = 0');
		}


		/***************
		 * Show preview of tt_content elements in page module
		 */
		$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['t3sbs_card'] =
		 \T3SBS\T3sbootstrap\Hooks\PageLayoutView\CardPreviewRenderer::class;

		/***************
		 * Add RootLine Fields: keywords & description
		 */
		$rootlinefields = &$GLOBALS["TYPO3_CONF_VARS"]["FE"]["addRootLineFields"];
		if($rootlinefields != '') $rootlinefields .= ' , ';
		$rootlinefields .= 'keywords,description';


	},
	$_EXTKEY, $_EXTCONF
);
