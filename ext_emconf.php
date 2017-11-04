<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "t3sbootstrap".
 *
 * Auto generated 04-11-2017 17:01
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'Bootstrap Components',
  'description' => 'Startup extension to use bootstrap 4 classes and components out of the box. Example and info: four.t3sbootstrap.de',
  'category' => 'templates',
  'author' => 'Helmut Hackbarth',
  'author_email' => 'typo3@t3solution.de',
  'state' => 'alpha',
  'uploadfolder' => true,
  'createDirs' => '',
  'clearCacheOnLoad' => 0,
  'version' => '4.0.4',
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '8.7.0-8.7.99',
      'fluid_styled_content' => '8.7.0-8.7.99',
      'gridelements' => '8.0.0-8.0.99',
      'dyncss' => '0.8.2-0.8.99',
      'dyncss_scss' => '1.1.1-1.1.99',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
    ),
  ),
  'autoload' => 
  array (
    'psr-4' => 
    array (
      'T3SBS\\T3sbootstrap\\' => 'Classes',
    ),
  ),
  'clearcacheonload' => false,
  'author_company' => NULL,
);

