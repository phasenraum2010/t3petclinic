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

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * ConfigController
 */
class TcaMatcher
{

	/**
	 * autoLayoutParent
	 *
	 * @return void
	 */
	public function autoLayoutParent($arguments)
	{
		$parent = false;
		if ( $arguments['record']['tx_gridelements_container'][0] ) {
		$parent_rec = $GLOBALS['TYPO3_DB']->exec_SELECTgetrows('*','tt_content','uid='.$arguments['record']['tx_gridelements_container'][0]);
			if ( $parent_rec[0]['tx_gridelements_backend_layout'] == 'autoLayout_row' ) {
				$parent = true;
			}
		}

		return $parent;
	}


	/**
	 * container_1 ($_EXTCONF['container'] in tt_content.php)
	 *
	 * @return void
	 */
	public function container_1($arguments)
	{
		return true;
	}


	/**
	 * container_0 ($_EXTCONF['container'] in tt_content.php)
	 *
	 * @return void
	 */
	public function container_0($arguments)
	{
		if ($arguments['record']['tx_gridelements_backend_layout'][0] == 'container') {
			return true;
		} else {
			return false;
		}
	}


	/**
	 * spacing_1 ($_EXTCONF['spacing'] in tt_content.php)
	 *
	 * @return void
	 */
	public function spacing_1($arguments)
	{
		return true;
	}


	/**
	 * spacing_0 ($_EXTCONF['spacing'] in tt_content.php)
	 *
	 * @return void
	 */
	public function spacing_0($arguments)
	{
		return false;
	}


	/**
	 * color_1 ($_EXTCONF['color'] in tt_content.php)
	 *
	 * @return void
	 */
	public function color_1($arguments)
	{
		return true;
	}


	/**
	 * color_0 ($_EXTCONF['color'] in tt_content.php)
	 *
	 * @return void
	 */
	public function color_0($arguments)
	{
		return false;
	}


	/**
	 * is child of flex-container
	 *
	 * @return void
	 */
	public function flexContainerParent($arguments)
	{
		$parent = false;
		$flexformService = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Service\\FlexFormService');
		if ( $arguments['record']['tx_gridelements_container'][0] ) {
			$parent_rec = $GLOBALS['TYPO3_DB']->exec_SELECTgetrows('*','tt_content','uid='.$arguments['record']['tx_gridelements_container'][0]);
			$flexconf = $flexformService->convertFlexFormContentToArray($parent_rec[0]['tx_t3sbootstrap_flexform']);
			if ( $parent_rec[0]['tx_gridelements_backend_layout'] == 'container' && $flexconf['flexContainer'] ) {
				$parent = true;
			}
		}

		return $parent;
	}

	/**
	 * isButton
	 *
	 * @return void
	 */
	public function isButton($arguments)
	{
		$button = false;
		$flexformService = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Service\\FlexFormService');
		if ( $arguments['record']['tx_gridelements_container'][0] ) {
			$parent_rec = $GLOBALS['TYPO3_DB']->exec_SELECTgetrows('*','tt_content','uid='.$arguments['record']['tx_gridelements_container'][0]);
			$flexconf = $flexformService->convertFlexFormContentToArray($parent_rec[0]['tx_t3sbootstrap_flexform']);
			if ( $flexconf['appearance'] == 'button' ) {
				$button = true;
			}
		}

		return $button;
	}

	/**
	 * isMenu
	 *
	 * @return void
	 */
	public function isMenu($arguments)
	{
		$menu = false;
		if ( substr($arguments['record']['CType'][0], 0, 4) == 'menu' ) {
			$menu = true;
		}

		return $menu;
	}


}
