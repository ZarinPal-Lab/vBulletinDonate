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

/*if (version_compare($vbulletin->versionnumber, '4.2', '>='))
{
	if (self::$db_alter->fetch_table_info('navigation'))
	{
		self::$db->hide_errors();
		self::$db->query_write("
			INSERT INTO " . TABLE_PREFIX . "navigation (
			navid, 
			name, 
			navtype, 
			displayorder, 
			parent, 
			url, 
			state, 
			scripts, 
			showperm, 
			productid, 
			username, 
			version, 
			dateline
			) VALUES
			(' ', 'tab_vbdonate_999', 'tab', '999', '', 'vbdonate.php?do=donate', 3, 'vbdonate', 'dbtech_vbdonate_cantuse', 'dbtech_vbdonate', 'ozzy47', '1.0.1', 1338031300),
			(' ', 'link_vbdonate_900', 'link', 10, 'tab_vbdonate_999', 'vbdonate.php?do=donate', 1, '', '', 'dbtech_vbdonate', 'ozzy47', '1.0.1', 1338031300),
			(' ', 'link_vbdonate_901', 'link', 20, 'tab_vbdonate_999', 'vbdonate.php?do=contrib_table', 1, '', 'dbtech_vbdonate_canseelist', 'dbtech_vbdonate', 'ozzy47', '1.0.1', 1338031300),
			(' ', 'link_vbdonate_902', 'link', 30, 'tab_vbdonate_999', 'vbdonate.php?do=my_contrib_table', 1, '', '', 'dbtech_vbdonate', 'ozzy47', '1.0.1', 1338031300),
			(' ', 'link_vbdonate_903', 'link', 50, 'vbmenu_community', 'vbdonate.php?do=contrib_table', 3, '', 'dbtech_vbdonate_qlinks_2', 'dbtech_vbdonate', 'ozzy47', '1.0.1', 1338223147),
			(' ', 'link_vbdonate_904', 'link', 60, 'vbmenu_qlinks', 'vbdonate.php?do=contrib_table', 3, '', 'dbtech_vbdonate_qlinks_1', 'dbtech_vbdonate', 'ozzy47', '1.0.1', 1338223193)
		");
	self::$db->hide_errors();
	self::report('Rebuilt Navigation Manager', 'Added vBDonate Tabs And SubLinks');
	}
}*/
if (version_compare($vbulletin->versionnumber, '4.2', '>='))
{
self::report('Rebuilt Navigation Manager', 'Added vBDonate Tabs And SubLinks');
}
/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 19:30, Fri Nov 25th 2011                                 * >>
<< * VER: 1.0.1                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/

?>