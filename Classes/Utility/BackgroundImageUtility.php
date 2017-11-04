<?php
namespace T3SBS\T3sbootstrap\Utility;

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

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Imaging\ImageManipulation\CropVariantCollection;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Extbase\Object\ObjectManager;


class BackgroundImageUtility implements SingletonInterface
{

	/**
	 * Returns the background image for the background-wrapper used in Bootstrapprocessor.php
	 *
	 * @return TypoScriptFrontendController
	 */
	public function getBgImage($uid, $table='tt_content', $jumbotron=FALSE)
	{
		$fileRepository = GeneralUtility::makeInstance(FileRepository::class);
		$filesFromRepository = $fileRepository->findByRelation($table, 'assets', $uid);
		if ( empty($filesFromRepository) ) {
			$filesFromRepository = $fileRepository->findByRelation($table, 'media', $uid);
		}

		$pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);

		if ($filesFromRepository) {
			$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
			$imageService = $objectManager->get('TYPO3\\CMS\\Extbase\\Service\\ImageService');
			$fileFromRepository = $filesFromRepository[0];
			$image = $imageService->getImage($fileFromRepository->getOriginalFile()->getUid(), $fileFromRepository->getOriginalFile(), 1);
			$imageUri_orig = $imageService->getImageUri($image);

			$processingInstructions = ['crop' => $fileFromRepository instanceof FileReference ? $fileFromRepository->getReferenceProperty('crop') : null];
			$cropVariantCollection = CropVariantCollection::create((string) $processingInstructions['crop']);

			$bgImages = [];
			# same in bgImageSize.js
			$mediaQueries = [576,768,992,1200,1920,2560];
			foreach ($mediaQueries as $key=>$querie) {
				if ($querie == 576) {
					$cropVariant = 'mobile';
				} elseif ($querie == 768) {
					$cropVariant = 'tablet';
				} else {
					$cropVariant = 'default';
				}
				$cropArea = $cropVariantCollection->getCropArea($cropVariant);
				$processingInstructions = [
					'width' => $querie,
					'crop' => $cropArea->isEmpty() ? null : $cropArea->makeAbsoluteBasedOnFile($image),
				];
				$processedImage = $imageService->applyProcessingInstructions($image, $processingInstructions);
				$bgImages[$querie] = $imageService->getImageUri($processedImage);
				if ($key === 0) {
					$imageUri_mobile = $bgImages[$querie];
				}
			}
			$bgImages['orig'] = $imageUri_orig;

			if ($jumbotron) {
				$pageRenderer->addInlineSetting('JUMBOTRON',$uid, json_encode($bgImages));
			} else {
				$pageRenderer->addInlineSetting('BGWRAPPER',$uid, json_encode($bgImages));
			}

			$jsFooterFile = 'EXT:t3sbootstrap/Resources/Public/Scripts/bgImageSize.js';
			$jsFooterFile = $GLOBALS['TSFE']->tmpl->getFileName($jsFooterFile);
			$pageRenderer->addJsFooterFile($jsFooterFile);

		} else {
			$imageUri_mobile = '';
		}

		return $imageUri_mobile;
	}
}
