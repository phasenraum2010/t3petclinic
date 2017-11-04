<?php
namespace T3SBS\T3sbootstrap\Controller;

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
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use \TYPO3\CMS\Core\Messaging\AbstractMessage;

/**
 * ConfigController
 */
class ConfigController extends ActionController
{
	/**
	 * configRepository
	 *
	 * @var \T3SBS\T3sbootstrap\Domain\Repository\ConfigRepository
	 * @inject
	 */
	protected $configRepository = null;


	/**
	 * Backend Template Container (build the heade in the BE)
	 *
	 * @var string
	 */
	protected $defaultViewObjectName = BackendTemplateView::class;


	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction()
	{
		$isSiteroot = self::isSiteroot();

		if ( $isSiteroot ) {

			$pageRepository = GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
			#$pageRepository->init(false);
			$configRepository = $this->configRepository->findAll();

			foreach ( $configRepository as $key => $config ) {
				$page = $pageRepository->getPage($config->getPid());
				$allConfig[$page['uid']]['title'] = $page['title'];
				$allConfig[$page['uid']]['uid'] = $page['uid'];
			}

			$assignedOptions['allConfig'] = $allConfig;
		}

		$rootConfig = $this->configRepository->findOneByPid(self::getRootPageUid());

		$assignedOptions['isSiteroot'] = $isSiteroot;
		$assignedOptions['rootConfig'] = $rootConfig ? TRUE : FALSE;
		$assignedOptions['config'] = $this->configRepository->findOneByPid((int)$_GET['id']);
		$assignedOptions['admin'] = $GLOBALS['BE_USER']->user['admin'];
		$assignedOptions['customScss'] = self::customScss();

		$this->view->assignMultiple($assignedOptions);
	}


	/**
	 * action new
	 *
	 * @return void
	 */
	public function newAction()
	{
		$assignedOptions = self::getFieldsOptions();

		$rootConfig = $this->configRepository->findOneByPid(self::getRootPageUid());

		if ( $rootConfig ) {
			// config from rootline
			if ( $this->settings['t3sbConfig']['rootline'] ) {
				$pageRepository = GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
				$rootLineArray = $pageRepository->getRootLine((int)$_GET['id']);
				// unset current page
				unset($rootLineArray[count($rootLineArray)-1]);

				foreach ($rootLineArray as $rootline) {
					$rootlineConfig = $this->configRepository->findOneByPid((int)$rootline['uid']);
					if ( !empty($rootlineConfig) ) break;
				}
				$assignedOptions['newConfig'] = self::getNewConfig($rootlineConfig);

			// config from rootpage
			} else {
				$assignedOptions['newConfig'] = self::getNewConfig($rootConfig);
			}

		} else {
			$newConfig = new \T3SBS\T3sbootstrap\Domain\Model\Config();
			// some defaults
			$newConfig->setHomepageUid((int)$_GET['id']);
			$newConfig->setPageTitle( 'jumbotron' );
			$newConfig->setPageTitlealign( 'center' );
			$newConfig->setNavbarImage($this->settings['defaultNavbarImagePath']);
			$newConfig->setNavbarEnable( 'light' );
			$newConfig->setNavbarLevels( 4 );
			$newConfig->setNavbarColor( 'warning' );
			$newConfig->setNavbarBrand( 'imgText' );
			$newConfig->setNavbarContainer( 'inside' );
			$newConfig->setJumbotronEnable( 1 );
			$newConfig->setJumbotronFluid( 1 );
			$newConfig->setJumbotronPosition( 'below' );
			$newConfig->setJumbotronContainer( 'container' );
			$newConfig->setJumbotronContainerposition( 'Inside' );
			$newConfig->setBreadcrumbEnable( 1 );
			$newConfig->setBreadcrumbCorner( 1 );
			$newConfig->setBreadcrumbPosition( 'belowJum' );
			$newConfig->setBreadcrumbContainer( 'container' );
			$newConfig->setSidebarLevels( 4 );
			$newConfig->setFooterEnable( 1 );
			$newConfig->setFooterFluid( 1 );
			$newConfig->setFooterContainer( 'container' );
			$newConfig->setFooterSticky( 1 );
			$newConfig->setFooterContainerposition( 'inside' );
			$newConfig->setFooterClass( 'bg-dark text-light' );
			$assignedOptions['newConfig'] = $newConfig;
		}

		$assignedOptions['pid'] = (int)$_GET['id'];

		$this->view->assignMultiple($assignedOptions);
	}


	/**
	 * action create
	 *
	 * @param \T3SBS\T3sbootstrap\Domain\Model\Config $newConfig
	 * @return void
	 */
	public function createAction(\T3SBS\T3sbootstrap\Domain\Model\Config $newConfig)
	{
		$this->addFlashMessage('The new configuration was created.', '', AbstractMessage::WARNING);

		if ( self::isSiteroot() ) {
			$homepageUid = (int)$_GET['id'];
		} else {
			$pageRepository = GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
			$rootLineArray = $pageRepository->getRootLine((int)$_GET['id']);
			$homepageUid = $rootLineArray[0]['uid'];
		}

		$newConfig->setHomepageUid($homepageUid);
		$newConfig->setPid((int)$_GET['id']);
		$this->configRepository->add($newConfig);

		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \T3SBS\T3sbootstrap\Domain\Model\Config $config
	 * @return void
	 */
	public function editAction(\T3SBS\T3sbootstrap\Domain\Model\Config $config)
	{
		$assignedOptions = self::getFieldsOptions();
		$assignedOptions['config'] = $config;
		$assignedOptions['pid'] = (int)$_GET['id'];
		$assignedOptions['admin'] = $GLOBALS['BE_USER']->user['admin'];

		$this->view->assignMultiple($assignedOptions);
	}

	/**
	 * action update
	 *
	 * @param \T3SBS\T3sbootstrap\Domain\Model\Config $config
	 * @return void
	 */
	public function updateAction(\T3SBS\T3sbootstrap\Domain\Model\Config $config)
	{
		$this->addFlashMessage('The configuration was updated.', '', AbstractMessage::WARNING);

		$this->configRepository->update($config);
		$this->redirect('edit',NULL,Null,array('config' => $config));
	}

	/**
	 * action delete
	 *
	 * @param \T3SBS\T3sbootstrap\Domain\Model\Config $config
	 * @return void
	 */
	public function deleteAction(\T3SBS\T3sbootstrap\Domain\Model\Config $config)
	{
		$this->addFlashMessage('The object was deleted.', '', AbstractMessage::WARNING);
		$this->configRepository->remove($config);
		$this->redirect('list');
	}


	/**
	* prepare options for select fields
	*
	* @return array
	*/
	public function getFieldsOptions()
	{

		$fields = [
			'pageTitleOptions' => 'page_title',
			'pageTitlealignOptions' => 'page_titlealign',
			'metaEnableOptions' => 'meta_enable',
			'metaContainerOptions' => 'meta_container',
			'navbarEnableOptions' => 'navbar_enable',
			'navbarBrandOptions' => 'navbar_brand',
			'navbarColorOptions' => 'navbar_color',
			'navbarContainerOptions' => 'navbar_container',
			'navbarPlacementOptions' => 'navbar_placement',
			'navbarTogglerOptions' => 'navbar_toggler',
			'navbarSearchboxOptions' => 'navbar_searchbox',
			'navbarBreakpointOptions' => 'navbar_breakpoint',
			'jumbotronPositions' => 'jumbotron_position',
			'jumbotronBgImageOptions' => 'jumbotron_bgimage',
			'jumbotronContainerOptions' => 'jumbotron_container',
			'jumbotronContainerpositionOptions' => 'jumbotron_containerposition',
			'breadcrumbPositions' => 'breadcrumb_position',
			'breadcrumbContainerOptions' => 'breadcrumb_container',
			'breadcrumbContainerpositionOptions' => 'breadcrumb_containerposition',
			'sidebarLeftOptions' => 'sidebar_enable',
			'sidebarRightOptions' => 'sidebar_rightenable',
			'footerContainerOptions' => 'footer_container',
			'footerContainerpositionOptions' => 'footer_containerposition'

		];

		foreach ($fields as $fieldKey=>$field) {

			$tcaItems[$fieldKey] = $GLOBALS['TCA']['tx_t3sbootstrap_domain_model_config']['columns'][$field]['config']['items'];

			foreach ($tcaItems[$fieldKey] as $key=>$value) {
				$entries[$fieldKey][$value[1]] = $value[0];
			}

				 $options = [];

				 foreach ($entries[$fieldKey] as $key=>$entry) {
				  $option = new \stdClass();
				  $option->key = $key;
				#$option->value = LocalizationUtility::translate('option.' . $entry, 't3sbootstrap');
				  $option->value = $entry;
				  $options[$key] = $option;
				 }

			$fieldsOptions[$fieldKey] = $options;
		}

		 return $fieldsOptions;
	}


	/**
	* take over $rootConfig settings
	*
	* @param \T3SBS\T3sbootstrap\Domain\Model\Config $rootConfig
	* @return \T3SBS\T3sbootstrap\Domain\Model\Config $newConfig
	*/
	public function getNewConfig(\T3SBS\T3sbootstrap\Domain\Model\Config $rootConfig)
	{

		$newConfig = new \T3SBS\T3sbootstrap\Domain\Model\Config();
		$newConfig->setCompany( $rootConfig->getCompany() );
		$newConfig->setHomepageUid( $rootConfig->getHomepageUid() );
		$newConfig->setPageTitle( $rootConfig->getPageTitle() );

		$newConfig->setMetaEnable( $rootConfig->getMetaEnable() );
		$newConfig->setMetaValue( $rootConfig->getMetaValue() );
		$newConfig->setMetaContainer( $rootConfig->getMetaContainer() );
		$newConfig->setMetaClass( $rootConfig->getMetaClass() );

		$newConfig->setNavbarEnable( $rootConfig->getNavbarEnable() );
		$newConfig->setNavbarLevels( $rootConfig->getNavbarLevels() );
		$newConfig->setNavbarEntrylevel( $rootConfig->getNavbarEntrylevel() );
		$newConfig->setNavbarExcludeuiduist( $rootConfig->getNavbarExcludeuiduist() );
		$newConfig->setNavbarIncludespacer( $rootConfig->getNavbarIncludespacer() );
		$newConfig->setNavbarJustify( $rootConfig->getNavbarJustify() );
		$newConfig->setNavbarSectionmenu( $rootConfig->getNavbarSectionmenu() );
		$newConfig->setNavbarMegamenu( $rootConfig->getNavbarMegamenu() );
		$newConfig->setNavbarHover( $rootConfig->getNavbarHover() );
		$newConfig->setNavbarBrand( $rootConfig->getNavbarBrand() );
		$newConfig->setNavbarImage( $rootConfig->getNavbarImage() );
		$newConfig->setNavbarColor( $rootConfig->getNavbarColor() );
		$newConfig->setNavbarContainer( $rootConfig->getNavbarContainer() );
		$newConfig->setNavbarPlacement( $rootConfig->getNavbarPlacement() );
		$newConfig->setNavbarToggler( $rootConfig->getNavbarToggler() );
		$newConfig->setNavbarBreakpoint( $rootConfig->getNavbarBreakpoint() );
		$newConfig->setNavbarBackground( $rootConfig->getNavbarBackground() );
		$newConfig->setNavbarClass( $rootConfig->getNavbarClass() );
		$newConfig->setNavbarHeight( $rootConfig->getNavbarHeight() );
		$newConfig->setNavbarSearchbox( $rootConfig->getNavbarSearchbox() );
		$newConfig->setNavbarLangUid( $rootConfig->getNavbarLangUid() );
		$newConfig->setNavbarLangHreflang( $rootConfig->getNavbarLangHreflang() );
		$newConfig->setNavbarLangTitle( $rootConfig->getNavbarLangTitle() );

		$newConfig->setJumbotronEnable( $rootConfig->getJumbotronEnable() );
		$newConfig->setJumbotronBgimage( $rootConfig->getJumbotronBgimage() );
		$newConfig->setJumbotronFluid( $rootConfig->getJumbotronFluid() );
		$newConfig->setJumbotronPosition( $rootConfig->getJumbotronPosition() );
		$newConfig->setJumbotronContainer( $rootConfig->getJumbotronContainer() );
		$newConfig->setJumbotronContainerposition( $rootConfig->getJumbotronContainerposition() );
		$newConfig->setJumbotronClass( $rootConfig->getJumbotronClass() );

		$newConfig->setBreadcrumbEnable( $rootConfig->getBreadcrumbEnable() );
		$newConfig->setBreadcrumbCorner( $rootConfig->getBreadcrumbCorner() );
		$newConfig->setBreadcrumbPosition( $rootConfig->getBreadcrumbPosition() );
		$newConfig->setBreadcrumbContainer( $rootConfig->getBreadcrumbContainer() );
		$newConfig->setBreadcrumbContainerposition( $rootConfig->getBreadcrumbContainerposition() );
		$newConfig->setBreadcrumbClass( $rootConfig->getBreadcrumbClass() );

		$newConfig->setSidebarEnable( $rootConfig->getSidebarEnable() );
		$newConfig->setSidebarRightenable( $rootConfig->getSidebarRightenable() );
		$newConfig->setSidebarLevels( $rootConfig->getSidebarLevels() );
		$newConfig->setSidebarExcludeuiduist( $rootConfig->getSidebarExcludeuiduist() );
		$newConfig->setSidebarIncludespacer( $rootConfig->getSidebarIncludespacer() );

		$newConfig->setFooterEnable( $rootConfig->getFooterEnable() );
		$newConfig->setFooterFluid( $rootConfig->getFooterFluid() );
		$newConfig->setFooterSticky( $rootConfig->getFooterSticky() );
		$newConfig->setFooterContainer( $rootConfig->getFooterContainer() );
		$newConfig->setFooterContainerposition( $rootConfig->getFooterContainerposition() );
		$newConfig->setFooterClass( $rootConfig->getFooterClass() );
		$newConfig->setFooterPid( $rootConfig->getFooterPid() );

		return $newConfig;
	}


	/**
	 * Returns isSiteroot
	 *
	 * @return boolean
	 */
	protected function isSiteroot()
	{
		$pageRepository = GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
		$page = $pageRepository->getPage((int)$_GET['id']);

		if ( $page['is_siteroot'] ) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	 * Returns the RootPageUid
	 *
	 * @return array
	 */
	protected function getRootPageUid()
	{
		if ( self::isSiteroot() ) {
			$rootPageUid = $page['uid'];
		} else {
			$pageRepository = GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
			$rootLineArray = $pageRepository->getRootLine((int)$_GET['id']);
			$rootPageUid = $rootLineArray[0]['uid'];
		}

		return $rootPageUid;
	}

	/**
	 * File custom.scss
	 *
	 * @return boolean
	 */
	protected function customScss()
	{
		if ( (int)$this->settings['customScss'] === 0 ) {
			$basePath = GeneralUtility::getFileAbsFileName('EXT:t3sbootstrap/Resources/Public/Contrib/Bootstrap/scss/_custom.scss');
			$baseContent = \TYPO3\CMS\Core\Utility\GeneralUtility::getURL($basePath);
			if ($baseContent != '//')
			file_put_contents($basePath, '//');
		} else {
			$customScssPath = $settings['customScssPath'] ? $settings['customScssPath'] : 'uploads/tx_t3sbootstrap/';
			$customScssFilePath = GeneralUtility::getFileAbsFileName($customScssPath);
			$customScssFileName = 'custom.scss';
			if (!file_exists($customScssFilePath.$customScssFileName)) {
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}


}
