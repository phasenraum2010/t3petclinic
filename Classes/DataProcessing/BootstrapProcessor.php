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
use TYPO3\CMS\Core\Page\PageRenderer;
use T3SBS\T3sbootstrap\Utility\BackgroundImageUtility;
use TYPO3\CMS\Extbase\Service\FlexFormService;

class BootstrapProcessor implements DataProcessorInterface
{

	/**
	 * The content object renderer
	 *
	 * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
	 */
	protected $contentObjectRenderer;


	/**
	 * The contentObject Configuration
	 *
	 * @var array
	 */
	protected $contentObjectConfiguration;

	/**
	 * The processor configuration
	 *
	 * @var array
	 */
	protected $processorConfiguration;

	/**
	 * The processedData
	 *
	 * @var array
	 */
	protected $processedData;

	/**
	 * The flexconf
	 *
	 * @var array
	 */
	protected $flexconf;

	/**
	 * The parentflexconf
	 *
	 * @var array
	 */
	protected $parentflexconf;


	/**
	 * Process data
	 *
	 * @param ContentObjectRenderer $cObj The data of the content element or page
	 * @param array $contentObjectConfiguration The configuration of Content Object
	 * @param array $processorConfiguration The configuration of this processor
	 * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
	 * @return array the processed data as key/value store
	 */
	public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration,	 array $processedData)
	{
		$flexFormService = GeneralUtility::makeInstance(FlexFormService::class);
		$this->flexconf = $flexFormService->convertFlexFormContentToArray($processedData['data']['tx_t3sbootstrap_flexform']);
		$this->parentflexconf = $flexFormService->convertFlexFormContentToArray($processedData['data']['parentgrid_tx_t3sbootstrap_flexform']);
		$this->contentObjectRenderer = $cObj;
		$this->contentObjectConfiguration = $contentObjectConfiguration;
		$this->processorConfiguration = $processorConfiguration;
		$this->processedData = $processedData;

		##############################################################################################################################################
		/**
		 * CType: Gridelements
		 */
		##############################################################################################################################################
		if ($this->processedData['data']['CType'] == 'gridelements_pi1') {

			$this->processedData['divWrap'] = FALSE;

			$class = self::getGeClass();

			/**
			 * Card Wrapper
			 */
			if ( $this->processedData['data']['tx_gridelements_backend_layout'] == 'card_wrapper' ) {
				$this->processedData['card_wrapper'] = $this->flexconf['card_wrapper'] ?: '';
				$this->processedData['card_wrapper'] .= $this->processedData['data']['tx_t3sbootstrap_extra_class'] ? ' '.$this->processedData['data']['tx_t3sbootstrap_extra_class'] : '';
			}

			/**
			 * Background Wrapper
			 */
			if ( $this->processedData['data']['tx_gridelements_backend_layout'] == 'background_wrapper' && $this->processedData['data']['assets'] ) {
				$this->processedData['bgImage'] = GeneralUtility::makeInstance(BackgroundImageUtility::class)->getBgImage($this->processedData['data']['uid']);
			}

			/**
			 * Carousel container
			 */
			if ( $this->processedData['data']['tx_gridelements_backend_layout'] == 'carousel_container' ) {

				$this->processedData['interval'] = $this->flexconf['interval'];
			}

			/**
			 * Parallax Wrapper
			 */
			if ( $this->processedData['data']['tx_gridelements_backend_layout'] == 'parallax_wrapper' && $this->processedData['data']['assets'] ) {
				$this->processedData['parallaxImage'] = GeneralUtility::makeInstance(BackgroundImageUtility::class)->getBgImage($this->processedData['data']['uid']);
				$this->processedData['speedFactor'] = $this->flexconf['speedFactor'];
				$this->processedData['bgColor'] = $this->flexconf['bgColor'];
				$this->processedData['paddingTopBottom'] = $this->flexconf['paddingTopBottom'];
			}

			/**
			 * Button group
			 */
			if ( $this->processedData['data']['tx_gridelements_backend_layout'] == 'button_group' ) {
				$this->processedData['buttonGroupAlign'] = $this->flexconf['align'] ?: '';
			}

			/**
			 * Collapse Container
			 */
			if ( $this->processedData['data']['tx_gridelements_backend_layout'] == 'collapsible_container' ) {
				$this->processedData['appearance'] = $this->flexconf['appearance'];
			}

			/**
			 * Collapse
			 */
			if ( $this->processedData['data']['tx_gridelements_backend_layout'] == 'collapsible_accordion' ) {
				$this->processedData['appearance'] = $this->parentflexconf['appearance'];
				$this->processedData['show'] = $this->flexconf['active'] ? ' show' : '';
				$this->processedData['expanded'] = $this->flexconf['active'] ? 'true' : 'false';
				$this->processedData['buttonstyle'] = $this->flexconf['style'] ? $this->flexconf['style'] : 'primary';
			}

			/**
			 * Grid
			 */
			if ( $this->processedData['data']['tx_gridelements_backend_layout'] == 'two_columns'
			 || $this->processedData['data']['tx_gridelements_backend_layout'] == 'three_columns'
			 || $this->processedData['data']['tx_gridelements_backend_layout'] == 'four_columns' ) {
				if ( $this->flexconf['equalWidth'] ) {
					$this->processedData['columnOne'] = 'col';
					$this->processedData['columnTwo'] = 'col';
					$this->processedData['columnThree'] = 'col';
					$this->processedData['columnFour'] =	 'col';
				} else {
					foreach ($this->flexconf as $key=>$grid) {
						if ($grid != '0') {
							if ( substr($key, 0, 2) == 'xs' ) {
								if ( substr($key, -3) == 'one' ) {
									$columnOne .= ' col-'.$grid;
								}
								if ( substr($key, -3) == 'two' ) {
									$columnTwo .= ' col-'.$grid;
								}
								if ( substr($key, -5) == 'three' ) {
									$columnThree .= ' col-'.$grid;
								}
								if ( substr($key, -4) == 'four' ) {
									$columnFour .= ' col-'.$grid;
								}
							} else {
								if ( substr($key, -3) == 'one' ) {
									$columnOne .= ' col-'.substr($key, 0, -4).'-'.$grid;
								}
								if ( substr($key, -3) == 'two' ) {
									$columnTwo .= ' col-'.substr($key, 0, -4).'-'.$grid;
								}
								if ( substr($key, -5) == 'three' ) {
									$columnThree .= ' col-'.substr($key, 0, -6).'-'.$grid;
								}
								if ( substr($key, -4) == 'four' ) {
									$columnFour .= ' col-'.substr($key, 0, -5).'-'.$grid;
								}
							}
						}
					}
					$this->processedData['columnOne'] = trim($columnOne);
					$this->processedData['columnTwo'] = trim($columnTwo);
					$this->processedData['columnThree'] = trim($columnThree);
					$this->processedData['columnFour'] = trim($columnOne);
				}
			}



			/**
			 * Modal
			 */
			if ( $this->processedData['data']['tx_gridelements_backend_layout'] == 'modal' ) {
					$this->processedData['modal']['animation'] = $this->flexconf['animation'];
					$this->processedData['modal']['size'] = $this->flexconf['size'];
					$this->processedData['modal']['button'] = $this->flexconf['button'];
					$this->processedData['modal']['style'] = $this->flexconf['style'];
			}

		##############################################################################################################################################
		} else {
		##############################################################################################################################################





			$this->processedData['divWrap'] = $this->processedData['data']['CType'] == 'shortcut' ? FALSE : TRUE;

			$class = self::getClass();

			/**
			 * Button
			 */
			if ( $this->processedData['data']['CType'] == 't3sbs_button' ) {
				$outline = $this->flexconf['outline'] ? 'outline-':'';
				$typolinkButtonClass = 'btn btn-'.$outline.$this->flexconf['style'];

				// if is child of gridelement (button_group)
				if ( $this->processedData['data']['parentgrid_tx_gridelements_backend_layout'] == 'button_group' ) {
					$this->processedData['divWrap'] = FALSE;
				} else {
					$typolinkButtonClass .= $this->flexconf['size'] ? ' '.$this->flexconf['size']:'';
					$typolinkButtonClass .= $this->flexconf['block'] ? ' btn-block':'';
				}

				$this->processedData['typolinkButtonClass'] = trim($typolinkButtonClass);
			}

			/**
			 * Textmedia / Textpic / Image
			 */
			if ( $this->processedData['data']['CType'] == 'textmedia'
			 || $this->processedData['data']['CType'] == 'text-pic'
			 || $this->processedData['data']['CType'] == 'image' ) {
				$this->processedData['addmedia']['imgclass'] = 'img-fluid';
				$this->processedData['addmedia']['imgclass'] .=	 $this->processedData['data']['imageborder'] ? ' border' :'';
				$this->processedData['addmedia']['imagezoom'] =	 $this->processedData['data']['image_zoom'];
				$this->processedData['addmedia']['CType'] =	 $this->processedData['data']['CType'];
			}

			/**
			 * Card
			 */
			if ( $this->processedData['data']['CType'] == 't3sbs_card' ) {
				$this->processedData['addmedia']['imgclass'] = $this->processedData['card']['image']['class'];
				$this->processedData['addmedia']['imgclass'] .=	 $this->processedData['data']['imageborder'] ? ' border' :'';
				$this->processedData['addmedia']['figureclass'] =  $this->processedData['data']['image_zoom'] ? ' text-center gallery' : ' text-center';
				$this->processedData['addmedia']['imagezoom'] =	 $this->processedData['data']['image_zoom'];
				$this->processedData['addmedia']['CType'] =	 $this->processedData['data']['CType'];
			}

			/**
			 * Media object
			 */
			if ( $this->processedData['data']['CType'] == 't3sbs_mediaobject' ) {

				$this->processedData['mediaobject']['order'] = $this->flexconf['order'] == 'right' ? 'right' : 'left';

				$figureclass = $this->flexconf['order'] == 'right' ? 'd-flex ml-3' : 'd-flex mr-3';
				switch ( $this->processedData['data']['imageorient'] ) {
						 case 91:
						 	$figureclass .= ' align-self-center';
						break;
						 case 92:
						 	$figureclass .= ' align-self-start';
						break;
						 case 93:
						 	$figureclass .= ' align-self-end';
						break;
						 default:
						 	$figureclass .= '';
				}

				$this->processedData['addmedia']['imgclass'] =	$this->processedData['data']['imageborder'] ? 'border' :'';
				$this->processedData['addmedia']['figureclass'] =  ' '.trim($figureclass);
				$this->processedData['addmedia']['figureclass'] .=	$this->processedData['data']['image_zoom'] ? ' gallery' : '';
				$this->processedData['addmedia']['imagezoom'] =	 $this->processedData['data']['image_zoom'];
				$this->processedData['addmedia']['CType'] =	 $this->processedData['data']['CType'];
			}

			/**
			 * Carousel
			 */
			if ( $this->processedData['data']['CType'] == 't3sbs_carousel' ) {
				$this->processedData['addmedia']['imgclass'] = 'img-fluid d-block w-100';
				$this->processedData['dimensions']['width'] = $this->parentflexconf['width'] ?: '';
				$this->processedData['dimensions']['height'] = $this->parentflexconf['height'] ?: '';
			}

			/**
			 * Table
			 */
			if ( $this->processedData['data']['CType'] == 'table' ) {
				$tableclass = $this->flexconf['tableClass'] ? ' '.$this->flexconf['tableClass']:'';
				$tableclass .= $this->flexconf['tableInverse'] ? ' table-inverse' : '';
				$tableclass .= $this->flexconf['tableResponsive'] ? ' table-responsive' : '';
				$tableclass .= $this->processedData['data']['tx_t3sbootstrap_extra_class'] ? ' '.$this->processedData['data']['tx_t3sbootstrap_extra_class'] : '';
				$this->processedData['tableclass'] = trim($tableclass);
			}


		} // end else CType
		##############################################################################################################################################

		/**
		 * CType: All
		 */
		$allClass = self::getAllClass();
		$this->processedData['class'] = trim($class.' '.$allClass);
		$this->processedData['style'] = self::getStyle();
		$this->processedData['anchor'] = FALSE;

		if ( $this->processedData['data']['imageorient'] == 17 || $this->processedData['data']['imageorient'] == 18 ) {
			$this->processedData['class'] .= ' clearfix';
		}


		/**
		 * Container
		 */
		if ( $this->processorConfiguration['container'] ) {

			if ( $this->processedData['data']['tx_t3sbootstrap_container'] ) {
				$this->processedData['container'] = $this->processedData['data']['tx_t3sbootstrap_container'];

				if ( $this->processedData['data']['tx_t3sbootstrap_extra_class'] && $this->processedData['data']['tx_gridelements_backend_layout'] == 'container' ) {
					$this->processedData['container'] .= ' '.$this->processedData['data']['tx_t3sbootstrap_extra_class'];
				}
				if ( $this->flexconf['flexContainer'] && $this->flexconf['flexExtraClass']) {
					$this->processedData['class'] .= ' '.$this->flexconf['flexExtraClass'];

				}
			} else {
				$this->processedData['container'] = FALSE;
			}

		} else {
			if ( $this->processedData['data']['tx_gridelements_backend_layout'] == 'container' ) {
				$this->this->processedData['container'] = $this->processedData['data']['tx_t3sbootstrap_container'];
				if ( $this->processedData['data']['tx_t3sbootstrap_extra_class'] ) {
					$this->processedData['container'] .= $this->processedData['data']['tx_t3sbootstrap_extra_class'] ? ' '.$this->processedData['data']['tx_t3sbootstrap_extra_class'] : '';
				}
			} else {
				$this->processedData['container'] = FALSE;
			}
		}

		/**
		 * Child of gridelement (autoLayout_row)
		 */
		if ( $this->processedData['data']['parentgrid_tx_gridelements_backend_layout'] == 'autoLayout_row' ) {
			$this->processedData['newLine'] = $this->flexconf['newLine'] ? TRUE : FALSE;
		}

		// anchor - section menu (one-page-layout)
		if ( ($this->processedData['data']['colPos'] === 0 || $this->processedData['data']['parentgrid_colPos'] === 0)
		 && ($this->processedData['data']['pid'] == self::getFrontendController()->id) ) {
			if ( self::getConfigurationValue('sectionmenu')
			 || (self::getConfigurationValue('sidebarleft') == 'Section')
			 || (self::getConfigurationValue('sidebarright') == 'Section') )
			{
			 $this->processedData['anchor'] = TRUE;
			}
		}

		/**
		 * Menu
		 */
		if ( substr($this->processedData['data']['CType'], 0, 4) == 'menu' ) {

			$this->processedData['menudirection'] = $this->flexconf['menudirection'] ? ' '.$this->flexconf['menudirection'] :'';

		}


		return $this->processedData;
	}


	/**
	 * Returns the CSS-class
	 *
	 * @return string
	 */
	protected function getClass()
	{

		if ( $this->processorConfiguration['cType'] ) {
			$class = 'fsc-default '. $this->processedData['data']['CType'];
		} else {
			$class = '';
		}

		/**
		 * Button
		 */
		if ( $this->processedData['data']['CType'] == 't3sbs_button' ) {
			// if is no child of gridelement (button_group)
			if ( $this->processedData['data']['parentgrid_tx_gridelements_backend_layout'] != 'button_group' ) {
				$class .= $this->processedData['data']['header_position'] ? ' text-'.$this->processedData['data']['header_position']:'';
			}
		}

		/**
		 * Card
		 */
		if ( $this->processedData['data']['CType'] == 't3sbs_card' ) {
			// Data from cardProzessor
			$class .= $this->processedData['card']['class'] ? ' '.$this->processedData['card']['class']:'';
		}

		/**
		 * All
		 */

		// if is child of gridelement (autoLayout_row)
		if ( $this->processedData['data']['parentgrid_tx_gridelements_backend_layout'] == 'autoLayout_row' ) {
			if ( $this->flexconf['gridSystem'] ) {
				switch ( $this->flexconf['gridSystem'] ) {
						 case 'equal':
							$class .= ' col';
						break;
						 case 'column':
							$class .= $this->flexconf['xsColumns'] ? ' col-'.$this->flexconf['xsColumns'] : '';
						break;
						 case 'variable':

						 if ( $this->flexconf['xsColumns'] == 'equal'
							|| $this->flexconf['smColumns'] == 'equal'
							|| $this->flexconf['mdColumns'] == 'equal'
							|| $this->flexconf['lgColumns'] == 'equal'
							|| $this->flexconf['xlColumns'] == 'equal' ) {

							$class .= $this->flexconf['xsColumns'] ? ' col-xs' : '';
							$class .= $this->flexconf['smColumns'] ? ' col-sm' : '';
							$class .= $this->flexconf['mdColumns'] ? ' col-md' : '';
							$class .= $this->flexconf['lgColumns'] ? ' col-lg' : '';
							$class .= $this->flexconf['xlColumns'] ? ' col-xl': '';

						} else {

							$class .= $this->flexconf['xsColumns'] ? ' col-'.$this->flexconf['xsColumns'] : '';
							$class .= $this->flexconf['smColumns'] ? ' col-sm-'.$this->flexconf['smColumns'] : '';
							$class .= $this->flexconf['mdColumns'] ? ' col-md-'.$this->flexconf['mdColumns'] : '';
							$class .= $this->flexconf['lgColumns'] ? ' col-lg-'.$this->flexconf['lgColumns'] : '';
							$class .= $this->flexconf['xlColumns'] ? ' col-xl-'.$this->flexconf['xlColumns'] : '';
						}
						break;
				}
			}
		}


		// if is child of gridelement (container)
		if ( $this->processedData['data']['parentgrid_tx_gridelements_backend_layout'] == 'container' ) {
			if ( $this->parentflexconf['flexContainer'] ) {
				if ($this->flexconf['responsiveVariations']) {
					$class .= $this->flexconf['alignSelf'] ? ' align-self-'.$this->flexconf['responsiveVariations'].'-'.$this->flexconf['flexContainer'] : '';
				} else {
					$class .= $this->flexconf['alignSelf'] ? ' align-self-'.$this->flexconf['alignSelf'] : '';
				}

				$class .= $this->flexconf['autoMargins'] ? ' '.$this->flexconf['autoMargins'].'-auto' : '';
				$class .= $this->flexconf['order'] ? ' order-'.$this->flexconf['order'] : '';
			}
		}


		return trim($class);
	}


	/**
	 * Returns the CSS-class for gridelements
	 *
	 * @return string
	 */
	protected function getGeClass()
	{
		/**
		 * CType: Gridelements
		 */
		if ( $this->processorConfiguration['cType'] ) {
			$class = 'ge ge_'. $this->processedData['data']['tx_gridelements_backend_layout'];
		} else {
			$class = '';
		}

		/**
		 * Background Wrapper
		 */
		if ( $this->processedData['data']['tx_gridelements_backend_layout'] == 'background_wrapper' ) {
			$class .= $this->flexconf['bgAttachmentFixed'] ? ' background-fixed' : '';
		}

		/**
		 * Button group
		 */
		if ( $this->processedData['data']['tx_gridelements_backend_layout'] == 'button_group' ) {
			$class .= $this->flexconf['vertical'] ? ' btn-group-vertical' : ' btn-group';
			$class .= $this->flexconf['size'] ? ' '.$this->flexconf['size'] : '';
		}

		/**
		 * Auto-layout row/column
		 */
		if ( $this->processedData['data']['tx_gridelements_backend_layout'] == 'autoLayout_row' ) {
			$class .= $this->flexconf['noGutters'] ? ' no-gutters' : '';
			if ($this->flexconf['responsiveVariations']) {
				$class .= $this->flexconf['justify'] ? ' justify-content-'.$this->flexconf['responsiveVariations'].'-'.$this->flexconf['justify'] : '';
				$class .= $this->flexconf['alignItem'] ? ' align-items-'.$this->flexconf['responsiveVariations'].'-'.$this->flexconf['alignItem'] : '';
			} else {
				$class .= $this->flexconf['alignItem'] ? ' align-items-'.$this->flexconf['alignItem'] : '';
				$class .= $this->flexconf['justify'] ? ' justify-content-'.$this->flexconf['justify'] : '';
			}
		}

		/**
		 * Container
		 */
		if ( $this->processedData['data']['tx_gridelements_backend_layout'] == 'container' ) {
			if ($this->flexconf['flexContainer']) {
				if ($this->flexconf['responsiveVariations']) {
					$class .= $this->flexconf['flexContainer'] ? ' d-'.$this->flexconf['responsiveVariations'].'-'.$this->flexconf['flexContainer'] : '';
					$class .= $this->flexconf['direction'] ? ' flex-'.$this->flexconf['responsiveVariations'].'-'.$this->flexconf['direction'] : '';
					$class .= $this->flexconf['justify'] ? ' justify-content-'.$this->flexconf['responsiveVariations'].'-'.$this->flexconf['justify'] : '';
					$class .= $this->flexconf['alignItem'] ? ' align-items-'.$this->flexconf['responsiveVariations'].'-'.$this->flexconf['alignItem'] : '';
					$class .= $this->flexconf['wrap'] ? ' flex-'.$this->flexconf['responsiveVariations'].'-'.$this->flexconf['wrap'] : '';
					$class .= $this->flexconf['alignContent'] ? ' align-content-'.$this->flexconf['responsiveVariations'].'-'.$this->flexconf['alignContent'] : '';
				} else {
					$class .= $this->flexconf['flexContainer'] ? ' d-'.$this->flexconf['flexContainer'] : '';
					$class .= $this->flexconf['direction'] ? ' flex-'.$this->flexconf['direction'] : '';
					$class .= $this->flexconf['justify'] ? ' justify-content-'.$this->flexconf['justify'] : '';
					$class .= $this->flexconf['alignItem'] ? ' align-items-'.$this->flexconf['alignItem'] : '';
					$class .= $this->flexconf['wrap'] ? ' flex-'.$this->flexconf['wrap'] : '';
					$class .= $this->flexconf['alignContent'] ? ' align-content-'.$this->flexconf['alignContent'] : '';
				}
			}
		}

		/**
		 * Grid
		 */
		if ( $this->processedData['data']['tx_gridelements_backend_layout'] == 'two_columns'
		 || $this->processedData['data']['tx_gridelements_backend_layout'] == 'three_columns'
		 || $this->processedData['data']['tx_gridelements_backend_layout'] == 'four_columns' ) {
			$class .= $this->flexconf['noGutters'] ? ' no-gutters' : '';
		}

		return trim($class);
	}


	/**
	 * Returns the CSS-class for all elements
	 *
	 * @return string
	 */
	protected function getAllClass()
	{
		// Spacing: padding
		if ( $this->processedData['data']['tx_t3sbootstrap_padding_sides'] ) {
			// on all 4 sides of the element
			if ( $this->processedData['data']['tx_t3sbootstrap_padding_sides'] == 'blank' ) {
				$class .= ' p-'.$this->processedData['data']['tx_t3sbootstrap_padding_size'];
			} else {
				$class .= ' p'.$this->processedData['data']['tx_t3sbootstrap_padding_sides'].'-'.$this->processedData['data']['tx_t3sbootstrap_padding_size'];
			}
		}
		// Spacing: margin
		if ( $this->processedData['data']['tx_t3sbootstrap_margin_sides'] ) {
			// on all 4 sides of the element
			if ( $this->processedData['data']['tx_t3sbootstrap_margin_sides'] == 'blank' ) {
				$class .= ' m-'.$this->processedData['data']['tx_t3sbootstrap_margin_size'];
			} else {
				$class .= ' m'.$this->processedData['data']['tx_t3sbootstrap_margin_sides'].'-'.$this->processedData['data']['tx_t3sbootstrap_margin_size'];
			}
		}
		// Layout
		if ($this->processedData['data']['layout']) {

			$frontendController = self::getFrontendController();

			$pagesTSconfig = $frontendController->getPagesTSconfig();
			$layout = $this->processedData['data']['layout'];
			$layoutAddItems = $pagesTSconfig['TCEFORM.']['tt_content.']['layout.']['addItems.'];
			$layoutClasses = $pagesTSconfig['TCEFORM.']['tt_content.']['layout.']['classes.'];
			$layoutAltLabels = $pagesTSconfig['TCEFORM.']['tt_content.']['layout.']['altLabels.'];

			if (isset($layoutAddItems) && key($layoutAddItems) === $layout) {
				$class .= ' layout-'.$layout;
			} elseif (isset($layoutAltLabels) && $layoutAltLabels[$layout]) {
				if (isset($layoutClasses) && $layoutClasses[$layout]) {
					$class .= ' layout-'.strtolower($layoutClasses[$layout]);
				} else {
					$class .= ' layout-'.str_replace(' ', '-', strtolower($layoutAltLabels[$layout]));
				}
			} else {
				$class .= ' layout-'.$layout;
			}
		}
		// Frame class
		if ($this->processedData['data']['frame_class'] != 'default') {
			$class .= ' frame-'.$this->processedData['data']['frame_class'];
		}
		// Align self
		if ($this->flexconf['responsiveVariations']) {
			$class .= $this->flexconf['alignSelf'] ? ' align-self-'.$this->flexconf['responsiveVariations'].'-'.$this->flexconf['alignSelf'] : '';
		} else {
			$class .= $this->flexconf['alignSelf'] ? ' align-self-'.$this->flexconf['alignSelf'] : '';
		}
		// Text color
		if ( $this->processedData['data']['tx_t3sbootstrap_textcolor'] ) {
			$class .= ' text-'.$this->processedData['data']['tx_t3sbootstrap_textcolor'];
		}
		// Context color
		if ( $this->processedData['data']['tx_t3sbootstrap_contextcolor'] ) {
			$class .= ' bg-'.$this->processedData['data']['tx_t3sbootstrap_contextcolor'];
		}
		// Extra class
		if ( $this->processedData['data']['tx_t3sbootstrap_extra_class'] ) {

			if ( $this->processedData['data']['tx_gridelements_backend_layout'] != 'container'
			 && $this->processedData['data']['tx_gridelements_backend_layout'] != 'card_wrapper'
			 && $this->processedData['data']['CType'] != 'table' ) {
				$class .= $this->processedData['data']['tx_t3sbootstrap_extra_class'] ? ' '.$this->processedData['data']['tx_t3sbootstrap_extra_class'] : '';
			}
		}
		// Border
		if ( $this->flexconf['border'] ) {
			$class .= ' border border-'.$this->flexconf['borderstyle'];
			$class .= $this->flexconf['borderradius'] ? ' '.$this->flexconf['borderradius'] : '';
		}

		return trim($class);
	}


	/**
	 * Returns the CSS-style
	 *
	 * @return string
	 */
	protected function getStyle()
	{
		if ( $this->processedData['data']['tx_t3sbootstrap_bgcolor'] && !$this->processedData['data']['tx_t3sbootstrap_contextcolor'] ) {
			$style = ' background-color: '.$this->processedData['data']['tx_t3sbootstrap_bgcolor'].';';
		}
		if ( $this->processedData['card']['style'] && $this->processedData['data']['parentgrid_tx_gridelements_backend_layout'] != 'card_wrapper' ) {
			$style .= ' '.$this->processedData['card']['style'];
		}

		if ( $this->processedData['data']['tx_gridelements_backend_layout'] == 'background_wrapper' ) {
			$style .= $this->flexconf['bgColor'] ? ' background-color:'.$this->flexconf['bgColor'].';' : '';
			$style .= $this->flexconf['paddingTopBottom'] ? ' padding:'.$this->flexconf['paddingTopBottom'].'rem 1rem;' : '';
		}

		return trim($style);
	}


	/**
	 * Get configuration value from processorConfiguration
	 * with when $dataArrayKey fallback to value from cObj->data array
	 *
	 * @param string $key
	 * @param string|NULL $dataArrayKey
	 * @return string
	 */
	protected function getConfigurationValue($key, $dataArrayKey = null)
	{
		$defaultValue = '';
		if ($dataArrayKey && isset($this->contentObjectRenderer->data[$dataArrayKey])) {
			$defaultValue = $this->contentObjectRenderer->data[$dataArrayKey];
		}
		return $this->contentObjectRenderer->stdWrapValue(
			$key,
			$this->processorConfiguration,
			$defaultValue
		);
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
