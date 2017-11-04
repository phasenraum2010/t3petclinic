<?php
namespace T3SBS\T3sbootstrap\ViewHelpers;

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


class PageUidViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Renders the TypoScript object in the given TypoScript setup path.
     *
     * @return intval
     */
    public function render()
    {
		return self::getFrontendController()->id;
	}


	/**
	 * Returns the frontend controller
	 *
	 * @return TypoScriptFrontendController
	 */
	protected function getFrontendController()
	{
		return $GLOBALS['TSFE'];
	}	    
    
}
