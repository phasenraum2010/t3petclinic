<?php
defined('TYPO3_MODE') or die();
call_user_func(
	function ($extKey) {

		/**
		 * Add extra field tx_t3sbootstrap_extra_class to sys_file_reference record
		 */
		$tempSysFileReferenceColumns = [
			'tx_t3sbootstrap_extra_class' => [
				'exclude' => 1,
				'label' => 'Extra Class',
				'config' => [
					'type' => 'input',
					'size' => 20,
					'eval' => 'trim',
					'valuePicker' => [
						'items' => [
							[ 'm-3 (margin)', 'm-3', ],
							[ 'mt-3 (margin-top)', 'mt-3', ],
							[ 'mb-3 (margin-bottom)', 'mb-3', ],
							[ 'ml-3 (margin-left)', 'ml-3', ],
							[ 'mr-3 (margin-right)', 'mr-3', ],
							[ 'mx-3 (margin-left and -right)', 'mx-3', ],
							[ 'my-3 (margin-top and -bottom)', 'my-3', ],							 ],
					],
				],
			],
		];

		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_file_reference',$tempSysFileReferenceColumns);
		unset($tempSysFileReferenceColumns);

		TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_reference', 'imageoverlayPalette','--linebreak--,tx_t3sbootstrap_extra_class','after:description');

	}, 't3sbootstrap'
);