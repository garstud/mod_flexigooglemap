<?php
/**
* @version 0.6.0 stable $Id: default.php yannick berges
* @package Joomla
* @subpackage FLEXIcontent
* @copyright (C) 2015 Berges Yannick - www.com3elles.com
* @license GNU/GPL v2

* special thanks to ggppdk and emmanuel dannan for flexicontent
* special thanks to my master Marc Studer

* FLEXIadmin module is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details. 
**/

//blocage des accés directs sur ce script
defined('_JEXEC') or die('Accés interdit');
jimport( 'joomla.application.component.controller' );
// Check if component is installed
if ( !JComponentHelper::isEnabled( 'com_flexicontent', true) ) {
   echo 'This modules requires component FLEXIcontent!';
   return;
}
// Inclut les méthodes du script de soutien
require_once dirname(__FILE__).'/helper.php';
$itemsLoc      = modFlexigooglemapHelper::getLoc($params);
$catid = $params->get('catid');
$fieldaddressid = $params->get('fieldaddressid');

$moduleclass_sfx  = htmlspecialchars($params->get('moduleclass_sfx'));

// Get Joomla Layout
require JModuleHelper::getLayoutPath('mod_flexigooglemap', $params->get('layout', 'default'));