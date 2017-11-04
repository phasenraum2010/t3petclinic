<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'ThomasWoehlke.T3petclinic',
            'T3petclinicplugin',
            [
                'Owner' => 'list, show, new, create, edit, update, delete',
                'Pet' => 'list, show, new, create, edit, update, delete',
                'PetType' => 'list, show, new, create, edit, update, delete',
                'Specialty' => 'list, show, new, create, edit, update, delete'
            ],
            // non-cacheable actions
            [
                'Owner' => 'create, update, delete',
                'Pet' => 'create, update, delete',
                'PetType' => 'create, update, delete',
                'Specialty' => 'create, update, delete'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    t3petclinicplugin {
                        iconIdentifier = t3petclinic-plugin-t3petclinicplugin
                        title = LLL:EXT:t3petclinic/Resources/Private/Language/locallang_db.xlf:tx_t3petclinic_t3petclinicplugin.name
                        description = LLL:EXT:t3petclinic/Resources/Private/Language/locallang_db.xlf:tx_t3petclinic_t3petclinicplugin.description
                        tt_content_defValues {
                            CType = list
                            list_type = t3petclinic_t3petclinicplugin
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				't3petclinic-plugin-t3petclinicplugin',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:t3petclinic/Resources/Public/Icons/user_plugin_t3petclinicplugin.svg']
			);
		
    }
);
