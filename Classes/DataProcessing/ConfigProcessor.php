<?php
namespace T3SBS\T3sbootstrap\DataProcessing;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentDataProcessor;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
use T3SBS\T3sbootstrap\Utility\BackgroundImageUtility;
use TYPO3\CMS\Core\Page\PageRenderer;

class ConfigProcessor implements DataProcessorInterface
{
	/**
	 * @var ContentDataProcessor
	 */
	protected $contentDataProcessor;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->contentDataProcessor = GeneralUtility::makeInstance(ContentDataProcessor::class);
	}

	/**
	 * Fetches records from the database as an array
	 *
	 * @param ContentObjectRenderer $cObj The data of the content element or page
	 * @param array $contentObjectConfiguration The configuration of Content Object
	 * @param array $processorConfiguration The configuration of this processor
	 * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
	 *
	 * @return array the processed data as key/value store
	 */
	public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData)
	{

		// the table to query
		$tableName = 'tx_t3sbootstrap_domain_model_config';
		$processorConfiguration['pidInList'] = self::getFrontendController()->id;

		// Execute a SQL statement to fetch the records from current page
		$records = $cObj->getRecords($tableName, $processorConfiguration);

		if ( empty($records) ) {

			$frontendController = self::getFrontendController();

			if ( $processorConfiguration['rootline'] ) {
				// config from rootline
				$rootLineArray = $frontendController->sys_page->getRootLine($processedData['data']['uid']);
				// unset current page
				unset($rootLineArray[count($rootLineArray)-1]);

				foreach ($rootLineArray as $rootline) {
					$processorConfiguration['pidInList'] = $rootline['uid'];
					$records = $cObj->getRecords($tableName, $processorConfiguration);

					if ( !empty($records) ) break;
				}
			} else {
				// config from root page
				if ( $processedData['data']['is_siteroot'] ) {
					$rootPageUid = $processedData['data']['uid'];
				} else {
					$rootLineArray = $frontendController->sys_page->getRootLine($processedData['data']['uid']);
					$rootPageUid = $rootLineArray[0]['uid'];
				}
				$processorConfiguration['pidInList'] = $rootPageUid;
				$records = $cObj->getRecords($tableName, $processorConfiguration);
			}
 		}

 		if ( empty($records) ) {

 			$processedData['noConfig'] = TRUE;

 			return $processedData;

 		} else {
			$cObj->start($records[0], $tableName);
			$processedRecordVariables = $this->contentDataProcessor->process($cObj, $processorConfiguration, $records[0]);
		}

		// override config by TS
		if ( $contentObjectConfiguration['settings.']['configOverride'] ) {
			foreach ( $contentObjectConfiguration['settings.']['override.'] as $key=>$override ) {
				if ( $override && $override[1] != '$' )
				$processedRecordVariables[$key] = $override;
			}
		}


#\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($processedRecordVariables, '$processedRecordVariables');


		/**
		 * General
		 */
		// company w/ multilingual support
		$company = $processedRecordVariables['company'];
		$companyArr = GeneralUtility::trimExplode('|', $company);
		$sysLanguageUid = $processedData['data']['sys_language_uid'];
		if ( $sysLanguageUid && $company ) {
			$company = $companyArr[$sysLanguageUid] ?: $company;
		} else {
			$company = $companyArr[0] ?: $company;
		}
		$processedData['config']['general']['company'] = trim($company);
		$processedData['config']['general']['homepageUid'] = $processedRecordVariables['homepage_uid'] ?: 1;
		$processedData['config']['general']['pageTitle'] = $processedRecordVariables['page_title'] ?: '';
		$processedData['config']['general']['pageTitlealign'] = $processedRecordVariables['page_titlealign'] ?: '';

		# flexible small columns
		$currentPage = self::getFrontendController()->page;
		$smallColumnsCurrent = (int)$currentPage['tx_t3sbootstrap_smallColumns'];
		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		$pageRepository = $objectManager->get('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
		$rootlinePage = $pageRepository->getPage(self::getFrontendController()->rootLine[0]['uid']);
		$smallColumnsRootline = (int)$rootlinePage['tx_t3sbootstrap_smallColumns'];
		$processedData['config']['general']['smallColumn'] = $smallColumnsCurrent ?: $smallColumnsRootline;

		// image from pages media
		if ( $processedRecordVariables['pagemedia'] ) {
			$processedData['pagemedia'] = $processedRecordVariables['pagemedia'];
		}

		/**
		 * Language Navigation
		 */
		$processedData['config']['lang']['uid'] = GeneralUtility::trimExplode(',', $processedRecordVariables['navbar_lang_uid']) ?: '';
		$processedData['config']['lang']['hreflang'] = GeneralUtility::trimExplode(',', $processedRecordVariables['navbar_lang_hreflang']) ?: '';
		$processedData['config']['lang']['title'] = GeneralUtility::trimExplode(',', $processedRecordVariables['navbar_lang_title']) ?: '';

		/**
		 * Meta Navigation
		 */
		if ( $processedRecordVariables['meta_enable'] ) {
			$processedData['config']['meta']['align'] = $processedRecordVariables['meta_enable'];
			$processedData['config']['meta']['container'] = $processedRecordVariables['meta_container'];

			$metaClass = $processedRecordVariables['meta_class'] ?: '';
			$processedData['config']['meta']['class'] = trim($metaClass);
		}

		/**
		 * Navbar
		 */
		if ( $processedRecordVariables['navbar_enable'] ) {
			$processedData['config']['navbar']['enable'] = $processedRecordVariables['navbar_enable'];
			$processedData['config']['navbar']['sectionMenu'] = $processedRecordVariables['navbar_sectionmenu'] ? ' section-menu' : '';
			$processedData['config']['navbar']['brand'] = $processedRecordVariables['navbar_brand'];
			$processedData['config']['navbar']['image'] = $processedRecordVariables['navbar_image']
			? $processedRecordVariables['navbar_image']	: $contentObjectConfiguration['settings.']['navbar.']['image.']['defaultPath'];
			$processedData['config']['navbar']['toggler'] = $processedRecordVariables['navbar_toggler'];

			if ( $processedRecordVariables['navbar_container'] == 'none' ) {
				$processedData['config']['navbar']['container'] = '';
			} else {
				if ( $processedRecordVariables['navbar_container'] == 'fluid' ) {
					$processedData['config']['navbar']['container'] = 'container-fluid';
				} else {
					$processedData['config']['navbar']['containerposition'] = $processedRecordVariables['navbar_container'];
					$processedData['config']['navbar']['container'] = 'container';
				}
			}

			$navbarClass = 'navbar-'.$processedRecordVariables['navbar_enable'];
			$navbarClass .= $processedRecordVariables['navbar_breakpoint'] ? ' navbar-expand-'.$processedRecordVariables['navbar_breakpoint'] : '';
			$navbarClass .= $processedRecordVariables['navbar_class'] ? ' '.$processedRecordVariables['navbar_class'] : '';

			if ( $processedRecordVariables['navbar_color'] == 'color' ) {
				if ( $processedRecordVariables['navbar_background'] ) {
					$navbarStyle = 'background-color: '.$processedRecordVariables['navbar_background'].';';
					$processedData['config']['navbar']['style'] = $navbarStyle;
				}
			} else {
				$navbarClass .= ' bg-'.$processedRecordVariables['navbar_color'];
			}

			if ($processedRecordVariables['navbar_placement']) {
				if ( $processedData['config']['navbar']['containerposition'] == 'outside' ) {
					$processedData['config']['navbar']['container'] =
					trim($processedData['config']['navbar']['container'].' '.$processedRecordVariables['navbar_placement']);
				} else {
					$navbarClass = $navbarClass.' '.$processedRecordVariables['navbar_placement'];
				}
			}

			$processedData['config']['navbar']['class'] = trim($navbarClass);
			$dropdown = $processedRecordVariables['navbar_placement'] == 'fixed-bottom' ? 'dropup' : 'dropdown';
			$processedData['config']['navbar']['dropdown'] = $dropdown;
			$processedData['config']['navbar']['megamenu'] = $processedRecordVariables['navbar_megamenu'];
			$processedData['config']['navbar']['placement'] = $processedRecordVariables['navbar_placement'];
			$processedData['config']['navbar']['justify'] = $processedRecordVariables['navbar_justify'] ? ' nav-fill w-100' : '';
			if ( $processedRecordVariables['navbar_searchbox'] ) {
				$processedData['config']['navbar']['searchbox'] = $processedRecordVariables['navbar_searchbox'];
				$processedData['config']['navbar']['searchboxcolor'] = $processedRecordVariables['navbar_enable'] == 'light' ? 'dark' : 'light';
			}
		}

		/**
		 * Jumbotron
		 */
		if ( $processedRecordVariables['jumbotron_enable'] ) {

			$processedData['config']['jumbotron']['enable'] = $processedRecordVariables['jumbotron_enable'];
			$processedData['config']['jumbotron']['fluid'] = $processedRecordVariables['jumbotron_fluid'];
			$processedData['config']['jumbotron']['position'] = $processedRecordVariables['jumbotron_position'];
			$processedData['config']['jumbotron']['container'] = $processedRecordVariables['jumbotron_container'];
			$processedData['config']['jumbotron']['containerposition'] = $processedRecordVariables['jumbotron_containerposition'];

			$jumbotronClass = $processedRecordVariables['jumbotron_class'] ?: '';
			$jumbotronClass .= $processedRecordVariables['jumbotron_fluid'] ? ' jumbotron-fluid' : '';
			$processedData['config']['jumbotron']['class'] = ' '.trim($jumbotronClass);
			# Image from pages media
			if ( $processedRecordVariables['jumbotron_bgimage'] == 'root' ) {
				$bgImage = $this->getBackgroundImageUtility()->getBgImage(self::getFrontendController()->id, 'pages', TRUE);
				if ( empty($bgImage) ) {
					$bgImage = $this->getBackgroundImageUtility()->getBgImage(self::getFrontendController()->rootLine[0]['uid'], 'pages', TRUE);
				}
				if ($bgImage)
				$processedData['config']['jumbotron']['bgImage'] = $bgImage;
			} elseif ( $processedRecordVariables['jumbotron_bgimage'] == 'page' ) {
				$bgImage = $this->getBackgroundImageUtility()->getBgImage(self::getFrontendController()->id, 'pages', TRUE);
				if ($bgImage)
				$processedData['config']['jumbotron']['bgImage'] = $bgImage;
			}
		}

		/**
		 * Breadcrumb
		 */

		if ( $processedRecordVariables['breadcrumb_enable'] ) {

			$processedData['config']['breadcrumb']['enable'] = $processedRecordVariables['breadcrumb_enable'];
			$processedData['config']['breadcrumb']['position'] = $processedRecordVariables['breadcrumb_position'];
			$processedData['config']['breadcrumb']['container'] = $processedRecordVariables['breadcrumb_container'];
			$processedData['config']['breadcrumb']['containerposition'] = $processedRecordVariables['breadcrumb_containerposition'];
			$processedData['config']['breadcrumb']['class'] = $processedRecordVariables['breadcrumb_class']
			? ' '.$processedRecordVariables['breadcrumb_class'] : '';
			$processedData['config']['breadcrumb']['class'] .= $processedRecordVariables['breadcrumb_corner'] ? ' rounded-0': '';
		}

		/**
		 * Sidebar / submenu
		 */
		if ( $processedRecordVariables['sidebar_enable'] ) {
			$processedData['config']['sidebar']['left'] = $processedRecordVariables['sidebar_enable'];
		}
		if ( $processedRecordVariables['sidebar_rightenable'] ) {
			$processedData['config']['sidebar']['right'] = $processedRecordVariables['sidebar_rightenable'];
		}

		/**
		 * Footer
		 */
		if ( $processedRecordVariables['footer_enable'] ) {

			$processedData['config']['footer']['enable'] = $processedRecordVariables['footer_enable'];
			$processedData['config']['footer']['sticky'] = $processedRecordVariables['footer_sticky'];
			$processedData['config']['footer']['fluid'] = $processedRecordVariables['footer_fluid'];
			$processedData['config']['footer']['container'] = $processedRecordVariables['footer_container'];
			$processedData['config']['footer']['containerposition'] = $processedRecordVariables['footer_containerposition'];

			$footerClass = $processedRecordVariables['footer_class'] ?: '';
			$footerClass .= $processedRecordVariables['footer_fluid'] ? ' jumbotron-fluid' : '';
			$footerClass .= $processedRecordVariables['footer_sticky'] ? ' footer-sticky' : '';
			$processedData['config']['footer']['class'] = trim($footerClass);

		}

		/**
		 * CSS & JS
		 */
		if ( $processedData['config']['navbar']['enable'] == 'slide' ) {
			$cssFile = 'EXT:t3sbootstrap/Resources/Public/Styles/slideNavbar.css';
			$cssFile = self::getFrontendController()->tmpl->getFileName($cssFile);

			$jsFooterFile = 'EXT:t3sbootstrap/Resources/Public/Scripts/slideNavbar.js';
			$jsFooterFile = self::getFrontendController()->tmpl->getFileName($jsFooterFile);

			$pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
			$pageRenderer->addCssFile($cssFile);
			$pageRenderer->addJsFooterFile($jsFooterFile);

		}

		return $processedData;
	}


	/**
	 * Returns $typoScriptFrontendController \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
	 *
	 * @return TypoScriptFrontendController
	 */
	protected function getFrontendController()
	{
		return $GLOBALS['TSFE'];
	}


	/**
	 * Returns an instance of the rbackground image utility
	 *
	 * @return BackgroundImageUtility
	 */
	protected function getBackgroundImageUtility()
	{
		return GeneralUtility::makeInstance(BackgroundImageUtility::class);
	}


}
