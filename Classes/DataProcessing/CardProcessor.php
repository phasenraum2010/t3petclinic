<?php
namespace T3SBS\T3sbootstrap\DataProcessing;

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
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

class CardProcessor implements DataProcessorInterface {


	/**
	 * Process data for a card, CType "t3sbs_card"
	 *
	 * @param ContentObjectRenderer $cObj The content object renderer, which contains data of the content element
	 * @param array $contentObjectConfiguration The configuration of Content Object
	 * @param array $processorConfiguration The configuration of this processor
	 * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
	 * @return array the processed data as key/value store
	 */
	public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration,	 array $processedData)
	{

		$flexformService = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Service\\FlexFormService');
		$pi_flexform = $flexformService->convertFlexFormContentToArray($processedData['data']['pi_flexform']);
		$tx_t3sbootstrap_flexform = $flexformService->convertFlexFormContentToArray($processedData['data']['tx_t3sbootstrap_flexform']);
		$flexconf = array_merge ($pi_flexform, $tx_t3sbootstrap_flexform);

		# List-group
		foreach($flexconf as $key=>$ff) {
			if ($key == 'list') {
				if ( is_array($ff['container']) ) {
					foreach($ff['container'] as $container) {
						if ($container['list']['group']) {
							$cardData[$key][] = $container['list']['group'];
						}
					}
				}
			} else {
				$cardData[$key] = $ff;
			}
		}

		# image position
		if ( (int)$processedData['data']['imageorient'] == 8 ) {
			$processedData['data']['imageorient'] = 'bottom';
		} else {
			$processedData['data']['imageorient'] = 'top';
		}

		# title position
		if ( $flexconf['title']['onTop'] && $processedData['data']['imageorient'] == 'top' && !$flexconf['image']['overlay'] ) {
			$cardData['title']['position'] = 'top';
		} else {
			$cardData['title']['position'] = 'default';
		}
		# text top
		if ( $cardData['text']['top'] && $cardData['text']['bottom'] ) {
			$cardData['button']['position'] = 'bottom';
		} elseif ( $cardData['text']['top'] ) {
			if ( $cardData['list'] ) {
				$cardData['button']['position'] = 'list';
			} else {
				$cardData['button']['position'] = 'top';
			}
		} else {
			$cardData['button']['position'] = 'bottom';
		}
		# button
		$cardData['button']['enable'] = $flexconf['button']['enable'];
		$cardData['button']['style'] = $flexconf['button']['style'];
		$cardData['button']['text'] = $flexconf['button']['text'];
		$cardData['button']['outline'] = $flexconf['button']['outline'];
		# image
		if ( $flexconf['image']['overlay'] ) {
			if ( $flexconf['header']['text'] && $flexconf['footer']['text'] ) {
				$cardData['image']['class'] = 'img-fluid';
			} elseif ( $flexconf['header']['text'] ) {
				$cardData['image']['class'] = 'card-img-bottom';
			} elseif ( $flexconf['footer']['text'] ) {
				$cardData['image']['class'] = 'card-img-top';
			} else {
				$cardData['image']['class'] = 'img-fluid';
			}
		} else {
			if ( $processedData['data']['imageorient'] == 'top' ) {
				if ( $flexconf['title']['onTop'] || $flexconf['header']['text'] ) {
					$cardData['image']['class'] = 'img-fluid';
				} else {
					$cardData['image']['class'] = 'card-img-top';
				}
			} else {
				if ( $flexconf['footer']['text'] ) {
					$cardData['image']['class'] = 'img-fluid';
				} else {
					$cardData['image']['class'] = 'card-img-bottom';
				}
			}
		}

		if ( !$flexconf['text']['top'] && !$flexconf['text']['bottom'] && !$processedData['data']['header'] && !$processedData['data']['subheader'] ) {
			$cardData['block']['enable'] = FALSE;
		} else {
			$cardData['block']['enable'] = TRUE;
		}

		if ( $flexconf['image']['overlay'] ) {
			$cardData['block']['class'] = 'card-img-overlay';
			if ( $flexconf['header']['text'] ) {
				$cardData['block']['class'] .= ' mt-3';
			}
		} else {
			$cardData['block']['class'] = 'card-body';
		}

		# card class
		$cardData['class'] = 'card';
		$cardData['class'] .= $processedData['data']['tx_t3sbootstrap_header_position'] ? ' '.$processedData['data']['tx_t3sbootstrap_header_position']:'';
		if ( $processedData['data']['header_position'] ) {
			$cardData['class'] .= ' text-'.$processedData['data']['header_position'];
		}
		if ( $processedData['data']['tx_t3sbootstrap_header_class'] ) {
			$cardData['headerClass'] = $processedData['data']['tx_t3sbootstrap_header_class'];
		}

		# card max-width
		$cardData['style'] = $processedData['gallery']['width'] && $flexconf['maxwidth'] ? ' max-width: '.$processedData['gallery']['width'].'px;' :'';

		$targetFieldName = (string)$cObj->stdWrapValue(
			'as',
			$processorConfiguration,
			'card'
		);

		$processedData[$targetFieldName] = $cardData;


		return $processedData;
	}

}