<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ThomasWoehlke.T3petclinic',
            'T3petclinicplugin',
            'T3PetclinicPlugin'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('t3petclinic', 'Configuration/TypoScript', 'T3Petclinic');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3petclinic_domain_model_owner', 'EXT:t3petclinic/Resources/Private/Language/locallang_csh_tx_t3petclinic_domain_model_owner.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_t3petclinic_domain_model_owner');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3petclinic_domain_model_pet', 'EXT:t3petclinic/Resources/Private/Language/locallang_csh_tx_t3petclinic_domain_model_pet.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_t3petclinic_domain_model_pet');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3petclinic_domain_model_pettype', 'EXT:t3petclinic/Resources/Private/Language/locallang_csh_tx_t3petclinic_domain_model_pettype.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_t3petclinic_domain_model_pettype');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3petclinic_domain_model_visit', 'EXT:t3petclinic/Resources/Private/Language/locallang_csh_tx_t3petclinic_domain_model_visit.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_t3petclinic_domain_model_visit');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3petclinic_domain_model_vet', 'EXT:t3petclinic/Resources/Private/Language/locallang_csh_tx_t3petclinic_domain_model_vet.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_t3petclinic_domain_model_vet');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3petclinic_domain_model_specialty', 'EXT:t3petclinic/Resources/Private/Language/locallang_csh_tx_t3petclinic_domain_model_specialty.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_t3petclinic_domain_model_specialty');

    }
);
