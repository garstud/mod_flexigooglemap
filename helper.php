<?php
/**
* @version 0.0.3 stable $Id: default.php yannick berges
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
abstract class modFlexigooglemapHelper
{
	public static function getLoc(&$params)
	{
        $catidmode = $params->get('catidmode');
        if ($catidmode ==1)
            {
        $app    = JFactory::getApplication();
        $jinput = $app->input;
        $cid = $jinput->get('cid', 0, 'int');
        $catid = $cid;
                }else{
                $catid = $params->get('catid');
        }
        $fieldaddressid = $params->get('fieldaddressid');
        
        //var_dump ($catid);
        global $globalcats;
        //var_dump ($globalcats);
        $catlist = !empty($globalcats[$catid]->descendants) ? $globalcats[$catid]->descendants : $catid;
        $catids_join = 'JOIN #__flexicontent_cats_item_relations AS rel ON rel.itemid = a.id ';
        //var_dump ($catlist);

        $catids_where = ' rel.catid IN ('.$catlist.') ';
        //var_dump ($catids_where);
		// recupere la connexion à la BD
		$db = JFactory::getDbo();
		$queryLoc = 'SELECT a.id, a.title, b.field_id, b.value , a.catid FROM #__content  AS a LEFT JOIN #__flexicontent_fields_item_relations AS b ON a.id = b.item_id '.$catids_join.' WHERE b.field_id = '.$fieldaddressid.' AND '.  $catids_where.' AND state = 1 ORDER BY title DESC LIMIT '. (int) $params->get('count');
        //var_dump ($queryLoc);
		$db->setQuery( $queryLoc );
		$itemsLoc = $db->loadObjectList();
        //var_dump ($itemsLoc);
		foreach ($itemsLoc as &$itemLoc) {
			$itemLoc->link = JRoute::_('index.php?option=com_flexicontent&task=items.edit&cid[]='.$itemLoc->id);
		}
		return $itemsLoc;
	}
	
}