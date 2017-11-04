<?php
defined('TYPO3_MODE') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
   't3petclinic',
   'tx_t3petclinic_domain_model_pettype'
);
