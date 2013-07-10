<?php
/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ******************************************************************** >>
<< * ---------------------------------------------------------------- * >>
<< * Copyright ©2011-2012 Ozzy47                                      * >>
<< * All Rights Reserved. 											  * >>
<< * This file may not be redistributed in whole or significant part. * >>
<< * ---------------------------------------------------------------- * >>
<< * You are not allowed to use this on your server unless the files  * >>
<< * you downloaded were done so with permission.					  * >>
<< * ---------------------------------------------------------------- * >>
<< ******************************************************************** >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/

	foreach (array
	(
		'dbtech_vbdonate_donations',
		'dbtech_vbdonate_slider'
	) 
	as $table)
	{
		self::$db->query_write("DROP TABLE IF EXISTS `" . TABLE_PREFIX . "{$table}`");
		self::report('Deleted Table', $table);
	}
	{
    	self::report('Deleted INFO', 'Donations, Amounts, Custom Content');
	}
	{
    	self::report('Deleted vBDonate Phrases', 'cphome, dbtech_vbdonate, error, vbsettings');
	}
	{
    	self::report('Deleted Banners','Deleted all custom banners from database');
	}

	self::$db->query_write("DELETE FROM `" . TABLE_PREFIX . "stylevar` WHERE `stylevarid` LIKE 'dbtech_vbdonate_%'");

	self::$db->query_write("DELETE FROM `" . TABLE_PREFIX . "stylevardfn` WHERE `stylevarid` LIKE 'dbtech_vbdonate_%'");
	
	{
    	self::report('Deleted Stylevars','Removed all vBDonate Stylevars');
	}
	{
    	self::report('Deleted Stylevar Definitions','Removed all vBDonate Stylevar Definitions');
	}

	if (version_compare($vbulletin->versionnumber, '4.2', '>='))
	{
		self::$db->query_write("DELETE FROM `" . TABLE_PREFIX . "navigation` WHERE `name` LIKE 'tab_vbdonate_999'");
		self::$db->query_write("DELETE FROM `" . TABLE_PREFIX . "navigation` WHERE `name` LIKE 'link_vbdonate_900'");
		self::$db->query_write("DELETE FROM `" . TABLE_PREFIX . "navigation` WHERE `name` LIKE 'link_vbdonate_901'");
		self::$db->query_write("DELETE FROM `" . TABLE_PREFIX . "navigation` WHERE `name` LIKE 'link_vbdonate_902'");
		self::$db->query_write("DELETE FROM `" . TABLE_PREFIX . "navigation` WHERE `name` LIKE 'link_vbdonate_903'");
		self::$db->query_write("DELETE FROM `" . TABLE_PREFIX . "navigation` WHERE `name` LIKE 'link_vbdonate_904'");
		self::$db->query_write("DELETE FROM `" . TABLE_PREFIX . "phrase` WHERE `product` LIKE 'dbtech_vbdonate'");

    	self::report('Deleted Tabs & Links','Removed Tabs & Links From Navigation Manager');
	}
	
	if (self::$db_alter->fetch_table_info('userfield'))
	{
		self::$db_alter->drop_field('dbtech_vbdonations_awards');
		self::report('Reverted Table', 'userfield');
	}	

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>