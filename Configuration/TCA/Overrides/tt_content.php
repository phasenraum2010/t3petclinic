<?php
defined('TYPO3_MODE') or die();
call_user_func(
	function ($extKey) {

	# Extension configuration
	$extconf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$extKey]);

	/***************
	 * Add new CTypes
	 */
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
		'tt_content',
		'CType',
		[
			'Bootstrap Media object',
			't3sbs_mediaobject',
			'content-textpic'
		],
		'textmedia',
		'after'
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
		'tt_content',
		'CType',
		[
			'Bootstrap Card',
			't3sbs_card',
			'bs-card'
		],
		't3sbs_mediaobject',
		'after'
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
		'tt_content',
		'CType',
		[
			'Bootstrap Carousel Item',
			't3sbs_carousel',
			'bs-carousel'
		],
		't3sbs_card',
		'after'
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
		'tt_content',
		'CType',
		[
			'Bootstrap Button',
			't3sbs_button',
			'bs-button'
		],
		't3sbs_carousel',
		'after'
	);


	/***************
	 * New fields in table:tt_content
	*/
	$tempContentColumns = [
		'tx_t3sbootstrap_header_display' => [
			'label' => 'Display headings',
			'exclude' => 1,
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['none',''],
					['display-1','display-1'],
					['display-2','display-2'],
					['display-3','display-3'],
					['display-4','display-4']
				],
				'default' => ''
			]
		],
		'tx_t3sbootstrap_header_class' => [
			'label' => 'Header Extra Class',
			'exclude' => 1,
				'config' => [
					'type' => 'input',
					'size' => 10,
					'eval' => 'trim',
					'valuePicker' => [
						'items' => [
							[ 'm-3 (margin)', 'm-3', ],
							[ 'mt-3 (margin-top)', 'mt-3', ],
							[ 'mb-3 (margin-bottom)', 'mb-3', ],
							[ 'ml-3 (margin-left)', 'ml-3', ],
							[ 'mr-3 (margin-right)', 'mr-3', ],
							[ 'mx-3 (margin-left and -right)', 'mx-3', ],
							[ 'my-3 (margin-top and -bottom)', 'my-3', ],
						],
					],
				],
		],
		'tx_t3sbootstrap_padding_sides' => [
			'label' => 'Padding spacing side',
			'exclude' => 1,
			'displayCond' => 'USER:T3SBS\T3sbootstrap\UserFunction\TcaMatcher->spacing_'.$extconf['spacing'],
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['no padding',''],
					['padding on all 4 sides','blank'],
					['padding-top','t'],
					['padding-bottom','b'],
					['padding-left','l'],
					['padding-right','r'],
					['padding-left and -right','x'],
					['padding-top and -bottom','y']
				],
				'default' => ''
			]
		],
		'tx_t3sbootstrap_padding_size' => [
			'label' => 'Padding spacing size',
			'exclude' => 1,
			'displayCond' => 'USER:T3SBS\T3sbootstrap\UserFunction\TcaMatcher->spacing_'.$extconf['spacing'],
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['0','0'],
					['1 (.25 rem)','1'],
					['2 (.5 rem)','2'],
					['3 (1 rem)','3'],
					['4 (1.5 rem)','4'],
					['5 (3 rem)','5']
				],
				'default' => ''
			]
		],
		'tx_t3sbootstrap_margin_sides' => [
			'label' => 'Margin spacing side',
			'exclude' => 1,
			'displayCond' => 'USER:T3SBS\T3sbootstrap\UserFunction\TcaMatcher->spacing_'.$extconf['spacing'],
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['no margin',''],
					['margin on all 4 sides','blank'],
					['margin-top','t'],
					['margin-bottom','b'],
					['margin-left','l'],
					['margin-right','r'],
					['margin-left and -right','x'],
					['margin-top and -bottom','y']
				],
				'default' => ''
			]
		],
		'tx_t3sbootstrap_margin_size' => [
			'label' => 'Margin spacing size',
			'exclude' => 1,
			'displayCond' => 'USER:T3SBS\T3sbootstrap\UserFunction\TcaMatcher->spacing_'.$extconf['spacing'],
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['0','0'],
					['1 (.25 rem)','1'],
					['2 (.5 rem)','2'],
					['3 (1 rem)','3'],
					['4 (1.5 rem)','4'],
					['5 (3 rem)','5']
				],
				'default' => ''
			]
		],
		'tx_t3sbootstrap_container' => [
			'label' => 'Container',
			'exclude' => 1,
			'displayCond' => 'USER:T3SBS\T3sbootstrap\UserFunction\TcaMatcher->container_'.$extconf['container'],
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['no container',''],
					['container','container'],
					['container-fluid','container-fluid'],
					['container-fluid px-0','container-fluid px-0']
				],
				'default' => ''
			]
		],
		'tx_t3sbootstrap_flexform' => [
			'exclude' => 1,
			'l10n_display' => 'hideDiff',
			'label' => ' ',
			'config' => [
				'type' => 'flex',
				'ds_pointerField' => 'tx_gridelements_backend_layout,CType',
				'ds' => [
					'default' => 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/Bootstrap.xml',
					'*,t3sbs_card' => 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/CardSetting.xml',
					'*,t3sbs_button' => 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/Button.xml',
					'*,t3sbs_mediaobject' => 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/Mediaobject.xml',
					'*,table' => 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/Table.xml',
					'card_wrapper,gridelements_pi1' => 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/Gridelements/CardWrapper.xml',
					'autoLayout_row,gridelements_pi1' => 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/Gridelements/AutoLayoutRow.xml',
					'button_group,gridelements_pi1' => 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/Gridelements/Buttongroup.xml',
					'container,gridelements_pi1' => 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/Gridelements/Container.xml',
					'two_columns,gridelements_pi1' => 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/Gridelements/TwoColumns.xml',
					'three_columns,gridelements_pi1' => 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/Gridelements/ThreeColumns.xml',
					'four_columns,gridelements_pi1' => 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/Gridelements/FourColumns.xml',
					'background_wrapper,gridelements_pi1' => 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/Gridelements/BackgroundWrapper.xml',
					'parallax_wrapper,gridelements_pi1' => 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/Gridelements/ParallaxWrapper.xml',
					'carousel_container,gridelements_pi1' => 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/Gridelements/CarouselContainer.xml',
					'collapsible_accordion,gridelements_pi1' => 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/Gridelements/Collapse.xml',
					'collapsible_container,gridelements_pi1' => 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/Gridelements/CollapseContainer.xml',
					'modal,gridelements_pi1' => 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/Gridelements/Modal.xml',
				]
			]
		],
		'tx_t3sbootstrap_extra_class' => [
			'exclude' => 1,
			'label'	 => 'Extra Class',
			'config' => [
				'type' => 'input',
				'size' => '35'
			]
		],

		'tx_t3sbootstrap_bgcolor' => [
			'label' => 'Background color',
			'displayCond' => 'USER:T3SBS\T3sbootstrap\UserFunction\TcaMatcher->color_'.$extconf['color'],
			'config' => [
				'type' => 'input',
				'renderType' => 'colorpicker',
				'size' => 10,
			],
		],
		'tx_t3sbootstrap_contextcolor' => [
			'label' => 'Context color',
			'exclude' => 1,
			'displayCond' => 'USER:T3SBS\T3sbootstrap\UserFunction\TcaMatcher->color_'.$extconf['color'],
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['none',''],
					['primary','primary'],
					['success','success'],
					['info','info'],
					['warning','warning'],
					['danger','danger'],
					['custom 1','customOne'],
					['custom 2','customTwo']
				],
				'default' => ''
			]
		],
		'tx_t3sbootstrap_textcolor' => [
			'label' => 'Text color',
			'exclude' => 1,
			'displayCond' => 'USER:T3SBS\T3sbootstrap\UserFunction\TcaMatcher->color_'.$extconf['color'],
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['default',''],
					['white','white'],
					['muted','muted'],
					['primary','primary'],
					['success','success'],
					['info','info'],
					['warning','warning'],
					['danger','danger']
				],
				'default' => ''
			]
		],

	];


	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content',$tempContentColumns);
	unset($tempContentColumns);

	/***************
	 * Button - t3sbs_button
	 */
	$GLOBALS['TCA']['tt_content']['types']['t3sbs_button'] = [
		'showitem' => '
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
				--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
				--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
			--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
				--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
				--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
				--palette--;;language,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
				--palette--;;hidden,
				--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,categories,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,rowDescription,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
			--div--;LLL:EXT:gridelements/Resources/Private/Language/locallang_db.xlf:gridElements, tx_gridelements_container, tx_gridelements_columns
		'
	];
	$GLOBALS['TCA']['tt_content']['types']['t3sbs_button']['columnsOverrides'] = [
	  'header_link' => [
		 'config' => [
			 'eval' => 'trim,required'
		 ]
	  ],
	  'header' => [
		 'config' => [
			 'eval' => 'trim,required'
		 ]
	  ],
	];


	/***************
	 * Carousel item - t3sbs_carousel
	 */
	$GLOBALS['TCA']['tt_content']['types']['t3sbs_carousel'] = [
			'showitem' => '
				--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
					--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
					--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
					bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
				--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.images,
					image,
				--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
					--palette--;;language,
				--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
					--palette--;;hidden,
					--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
				--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
					categories,
				--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
					rowDescription,
				--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
			--div--;LLL:EXT:gridelements/Resources/Private/Language/locallang_db.xlf:gridElements, tx_gridelements_container, tx_gridelements_columns
			',
			'columnsOverrides' => [
				'bodytext' => [
					'config' => [
						'enableRichtext' => true,
						'richtextConfiguration' => 'default'
					]
				],
		 		'image' => [
					'config' => [
						'maxitems' => 1
					]
				]
			]
	];


	/***************
	 * Media object - t3sbs_mediaobject
	 */
	$GLOBALS['TCA']['tt_content']['types']['t3sbs_mediaobject'] = $GLOBALS['TCA']['tt_content']['types']['textmedia'];
	$GLOBALS['TCA']['tt_content']['types']['t3sbs_mediaobject']['columnsOverrides'] = [
		'bodytext' => [
			'config' => [
				'enableRichtext' => true,
				'richtextConfiguration' => 'default'
			]
		],
   		'assets' => [
			'config' => [
				'maxitems' => 1
			]
		]
	];


	/***************
	 * Card - t3sbs_card
	 */
	$GLOBALS['TCA']['tt_content']['types']['t3sbs_card'] = [
		'showitem' => '
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
				--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
				--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
			--div--;Content,pi_flexform;Card Content,
			--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.media,
				assets,
				--palette--;LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.palette.mediaAdjustments;mediaAdjustments,
				--palette--;LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.palette.gallerySettings;gallerySettings,
				--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.imagelinks;imagelinks,
			--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
				--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
				--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
				--palette--;;language,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
				--palette--;;hidden,
				--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,categories,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,rowDescription,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
			--div--;LLL:EXT:gridelements/Resources/Private/Language/locallang_db.xlf:gridElements, tx_gridelements_container, tx_gridelements_columns
		',
		'columnsOverrides' => [
			'assets' => [
				'config' => [
					'maxitems' => 1
				]
			]
		]
	];
	// Add flexform
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('*', 'FILE:EXT:t3sbootstrap/Configuration/FlexForms/CardContent.xml', 't3sbs_card');


	/***************
	 * Bullets
	 */
	// add extra column
	$GLOBALS['TCA']['tt_content']['columns']['bullets_type']['config']['items'][2] = ['BS Inline list', 2];
	$GLOBALS['TCA']['tt_content']['columns']['bullets_type']['config']['items'][3] = ['BS Unstyled list',3];
	$GLOBALS['TCA']['tt_content']['columns']['bullets_type']['config']['items'][4] = ['BS Listengruppen',4];
	$GLOBALS['TCA']['tt_content']['columns']['bullets_type']['config']['items'][5] = ['BS Definition list (use pipe "|")',5];


	/***************
	 * Gridelements
	 */
	$GLOBALS['TCA']['tt_content']['types']['gridelements_pi1']['showitem'] = str_replace('media,', '', $GLOBALS['TCA']['tt_content']['types']['gridelements_pi1']['showitem']);
	$GLOBALS['TCA']['tt_content']['types']['gridelements_pi1']['showitem'] .= ',--div--;Background-Image,assets';
	$GLOBALS['TCA']['tt_content']['types']['gridelements_pi1']['columnsOverrides'] = [
		'assets' => [
			'config' => [
				'maxitems' => 1
			],
			'displayCond' => [
				'OR' => [
					'FIELD:tx_gridelements_backend_layout:=:background_wrapper',
					'FIELD:tx_gridelements_backend_layout:=:parallax_wrapper'
				]
			]
		],
		'header_layout' => [
			'displayCond' => 'FIELD:tx_gridelements_backend_layout:!=:collapsible_accordion',
		],
		'tx_t3sbootstrap_header_display' => [
			'displayCond' => 'FIELD:tx_gridelements_backend_layout:!=:collapsible_accordion',
		],
		'date' => [
			'displayCond' => 'FIELD:tx_gridelements_backend_layout:!=:collapsible_accordion',
		],
		'header_link' => [
			'displayCond' => 'FIELD:tx_gridelements_backend_layout:!=:collapsible_accordion',
		]

	];



	# add header_display to palette header
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
		'tt_content',
		'header',
		'tx_t3sbootstrap_header_display',
		'after:header_layout'
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
		'tt_content',
		'headers',
		'tx_t3sbootstrap_header_display',
		'after:header_layout'
	);

	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
		'tt_content',
		'header',
		'tx_t3sbootstrap_header_class',
		'after:header_position'
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
		'tt_content',
		'headers',
		'tx_t3sbootstrap_header_class',
		'after:header_position'
	);


	# add palette bootstrap
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
		'tt_content',
		'--palette--;Bootstrap Color;bootstrapColor',
		'',
		'after:layout'
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
		'tt_content',
		'--palette--;Bootstrap Utilities;bootstrap',
		'',
		'after:layout'
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
		'tt_content',
		'--palette--;Bootstrap Spacing;bootstrapSpacing',
		'',
		'after:layout'
	);


	$GLOBALS['TCA']['tt_content']['palettes']['bootstrapSpacing'] = [
	  'showitem' => 'tx_t3sbootstrap_padding_sides, tx_t3sbootstrap_padding_size, --linebreak--,
	  tx_t3sbootstrap_margin_sides, tx_t3sbootstrap_margin_size'
	];

	$GLOBALS['TCA']['tt_content']['palettes']['bootstrap'] = [
	  'showitem' => 'tx_t3sbootstrap_extra_class,
	  --linebreak--, tx_t3sbootstrap_container,
	  --linebreak--, tx_t3sbootstrap_flexform'
	];

	$GLOBALS['TCA']['tt_content']['palettes']['bootstrapColor'] = [
	  'showitem' => 'tx_t3sbootstrap_contextcolor, tx_t3sbootstrap_bgcolor, tx_t3sbootstrap_textcolor'
	];


}, 't3sbootstrap'
);
