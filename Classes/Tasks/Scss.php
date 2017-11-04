<?php
namespace T3SBS\T3sbootstrap\Tasks;

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

class Scss extends \TYPO3\CMS\Scheduler\Task\AbstractTask {

	public function execute() {

		$this->configurationManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
		$settings = $this->configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
			't3sbootstrap',
			'm1'
		);

		$basePath = GeneralUtility::getFileAbsFileName('EXT:t3sbootstrap/Resources/Public/Contrib/Bootstrap/scss/_custom.scss');

		if ( $settings['customScss'] ) {

			$customScssPath = $settings['customScssPath'] ? $settings['customScssPath'] : 'uploads/tx_t3sbootstrap/';
			$customScssFilePath = GeneralUtility::getFileAbsFileName($customScssPath);
			$customScssFileName = 'custom.scss';

			if (!file_exists($customScssFilePath.$customScssFileName)) {

				$customScssFile = GeneralUtility::getURL($customScssFilePath . $customScssFileName);
				$baseContent = GeneralUtility::getURL($basePath);

				if ( !$customScssFile || $baseContent == '//' ) {

					if (!is_dir($customScssFilePath)) {
						mkdir($customScssFilePath);
					}

					$baseContent = '@import "../../../../../../../../'.$customScssPath.$customScssFileName.'";';
					file_put_contents($basePath, $baseContent);

					$bs_variables = file_get_contents(GeneralUtility::getFileAbsFileName('EXT:t3sbootstrap/Resources/Public/Contrib/Bootstrap/scss/_variables.scss'));
					$bs_variables = str_replace(' !default', '', $bs_variables);

					GeneralUtility::writeFile($customScssFilePath . $customScssFileName, $bs_variables);
				}
			}
		} else {
			file_put_contents($basePath, '//');
		}

		return TRUE;
	}
}
