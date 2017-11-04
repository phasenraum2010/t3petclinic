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

class ContentUidViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

	/**
	 * @var Content Object
	 */
	protected $cObj;
	

    /**
     * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager
     */
    public function injectConfigurationManager(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager)
    {
        $this->configurationManager = $configurationManager;
    }


    /**
     * Renders the TypoScript object in the given TypoScript setup path.
     *
     * @return intval
     */
    public function render()
    {

		$this->cObj = $this->configurationManager->getContentObject();

		return $this->cObj->data['uid'];

    }
  
}
