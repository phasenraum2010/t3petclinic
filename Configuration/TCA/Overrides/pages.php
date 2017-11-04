<?php
defined('TYPO3_MODE') or die();
call_user_func(
	function ($extKey) {

		/**
		 * Add extra field tx_t3sbootstrap_container to pages record
		 */
		$tempPagesColumns = [
			'tx_t3sbootstrap_smallColumns' => [
				'label' => 'Small columns width (makes no sense for Backend Layout "1 Column")',
				'exclude' => 1,
				'config' => [
					'type' => 'select',
					'renderType' => 'selectSingle',
					'items' => [
						['3',3],
						['2',2]
					],
					'default' => ''
				]
			],
			'tx_t3sbootstrap_container' => [
				'label' => 'Container (for the whole page)',
				'exclude' => 1,
				'config' => [
					'type' => 'select',
					'renderType' => 'selectSingle',
					'items' => [
						['no container',''],
						['container','container'],
						['container-fluid','container-fluid']
					],
					'default' => ''
				]
			],
			'tx_t3sbootstrap_linkToTop' => [
				'exclude' => 1,
				'label' => 'Link to top',
				'config' => [
						'type' => 'check',
				]
			]
		];

		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages',$tempPagesColumns);
		unset($tempPagesColumns);

		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('pages', 'layout','--linebreak--,tx_t3sbootstrap_smallColumns','after:backend_layout_next_level');
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('pages', 'layout','--linebreak--,tx_t3sbootstrap_container','after:tx_t3sbootstrap_smallColumns');
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('pages', 'layout','--linebreak--,tx_t3sbootstrap_linkToTop','after:tx_t3sbootstrap_container');

		/***************
		 * Register PageTSConfig Files
		*/
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
			't3sbootstrap',
			'Configuration/TSConfig/Registered/Flag.ts',
			'Set the default language label and flag to german'
		);
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
			't3sbootstrap',
			'Configuration/TSConfig/Registered/Textpic.ts',
			'Remove CType textpic'
		);
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
			't3sbootstrap',
			'Configuration/TSConfig/Registered/Text.ts',
			'Remove CType text'
		);
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
			't3sbootstrap',
			'Configuration/TSConfig/Registered/Image.ts',
			'Remove CType image'
		);


	}, 't3sbootstrap'
);