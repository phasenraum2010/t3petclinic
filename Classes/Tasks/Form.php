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

class Form extends \TYPO3\CMS\Scheduler\Task\AbstractTask {

	public function execute() {

		$customTemplatePath = 'fileadmin/T3SBForm/Templates/';
		$customTemplateFilePath = GeneralUtility::getFileAbsFileName($customTemplatePath);
		$customTemplateFileName = 'Form.html';

		if (!file_exists($customTemplateFilePath.$customTemplateFileName)) {

			$basePath = 'EXT:t3sbootstrap/Resources/Private/Extensions/Form/';

			$setupPath = GeneralUtility::getFileAbsFileName($basePath.'BaseSetup.yaml');
			$setupContent = GeneralUtility::getURL($setupPath);

			$customSetupPath = 'fileadmin/T3SBForm/';
			$customSetupFilePath = GeneralUtility::getFileAbsFileName($customSetupPath);
			if (!is_dir($customSetupFilePath)) {
				mkdir($customSetupFilePath);
			}

			$customSetupFileName = 'BaseSetup.yaml';

			if (!file_exists($customSetupFilePath.$customSetupFileName)) {
				GeneralUtility::writeFile($customSetupFilePath . $customSetupFileName, $setupContent);
			}

			$formPath = GeneralUtility::getFileAbsFileName($basePath.'ContactForm.yaml');
			$formContent = GeneralUtility::getURL($formPath);

			$customFormPath = 'fileadmin/T3SBForm/Form/';
			$customFormFilePath = GeneralUtility::getFileAbsFileName($customFormPath);
			if (!is_dir($customFormFilePath)) {
				mkdir($customFormFilePath);
			}

			$customFormFileName = 'ContactForm.yaml';

			if (!file_exists($customFormFilePath.$customFormFileName)) {
				GeneralUtility::writeFile($customFormFilePath . $customFormFileName, $formContent);
			}

			$templatePath = GeneralUtility::getFileAbsFileName($basePath.'Form.html');
			$templateContent = GeneralUtility::getURL($templatePath);

			if (!is_dir($customTemplateFilePath)) {
				mkdir($customTemplateFilePath);
			}

			GeneralUtility::writeFile($customTemplateFilePath . $customTemplateFileName, $templateContent);

			$finisherDirPath = 'fileadmin/T3SBForm/Templates/Finishers/';
			$finisherDirPath = GeneralUtility::getFileAbsFileName($finisherDirPath);
			if (!is_dir($finisherDirPath)) {
				mkdir($finisherDirPath);
			}
			$emailDirPath = 'fileadmin/T3SBForm/Templates/Finishers/Email/';
			$emailDirPath = GeneralUtility::getFileAbsFileName($emailDirPath);
			if (!is_dir($emailDirPath)) {
				mkdir($emailDirPath);
			}

			$emailPath = GeneralUtility::getFileAbsFileName($basePath.'Html.html');
			$emailContent = GeneralUtility::getURL($emailPath);


			$emailFileName = 'Html.html';

			if (!file_exists($emailFormFilePath.$emailFormFileName)) {
				GeneralUtility::writeFile($emailDirPath.$emailFileName, $emailContent);
			}

		}

		return TRUE;
	}
}
