<?php
namespace T3SBS\T3sbootstrap\UserFunction;

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

/**
 * Bootstrap condition (used in ../TSConfig/BackendLayouts/BootstrapCondition.ts)
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;


class BootstrapCondition extends \TYPO3\CMS\Core\Configuration\TypoScript\ConditionMatching\AbstractCondition
{

	/**
	 * Evaluate condition
	 *
	 * @param array $conditionParameters
	 * @return bool
	 */
	public function matchCondition(array $conditionParameters)
	{
		$result = FALSE;

		if ( $_GET['id'] && TYPO3_MODE == 'BE' ) {

			$pid = (int)$_GET['id'];

			$objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
			$configRepository = $objectManager->get('T3SBS\\T3sbootstrap\\Domain\\Repository\\ConfigRepository');
			$config = $configRepository->findOneByPid($pid);

			if ( empty($config) ) {

				$pageRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
				$rootLineArray = $pageRepository->getRootLine((int)$_GET['id']);
				// unset current page
				unset($rootLineArray[count($rootLineArray)-1]);

				foreach ($rootLineArray as $rootline) {
					$config = $configRepository->findOneByPid((int)$rootline['uid']);
					if ( !empty($config) ) break;
				}
			}

			if ( !empty($config) ) {
				if ( $config->getJumbotronEnable() ) {
					if ( $config->getFooterEnable() ) {
						// Content, Jumbotron & Footer (do nothing)
					} else {
						// Content & Jumbotron
						if ($conditionParameters[0] == 'Jumbotron') {
								 $result = TRUE;
						}
					}
				} else {
					if ( $config->getFooterEnable() ) {
						// Content & Footer
						if ($conditionParameters[0] == 'Footer') {
								 $result = TRUE;
						}
					} else {
						// Content only (no Jumbotron & no Footer)
						if ($conditionParameters[0] == 'Content') {
								 $result = TRUE;
						}
					}
				}
			}
		}

		return $result;
	}

}