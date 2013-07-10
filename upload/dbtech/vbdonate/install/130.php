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

	if (self::$db_alter->fetch_table_info('dbtech_vbdonate_donations'))
	{
		self::$db->hide_errors();
		self::$db->query_write("
			ALTER TABLE " . TABLE_PREFIX . "dbtech_vbdonate_donations CHANGE amount amount DOUBLE( 10, 2 ) NOT NULL"
		);
		self::$db->show_errors();
		self::report('Altered Table', 'amount');
	}
		
	if (self::$db_alter->fetch_table_info('dbtech_vbdonate_donations'))
	{
		self::$db->hide_errors();	
		self::$db->query_write("
			ALTER TABLE " . TABLE_PREFIX . "dbtech_vbdonate_donations ADD fee DOUBLE( 10, 2 ) NOT NULL AFTER amount"
		);
		self::$db->hide_errors();	
		self::report('Added Row to dbtech_vbdonate_donations', 'fee');
	}
	
	if (self::$db_alter->fetch_table_info('dbtech_vbdonate_donations'))
	{
		self::$db->hide_errors();	
		self::$db->query_write("
			ALTER TABLE " . TABLE_PREFIX . "dbtech_vbdonate_donations ADD tax DOUBLE( 10, 2 ) NOT NULL AFTER fee"
		);
		self::$db->hide_errors();	
		self::report('Added Row to dbtech_vbdonate_donations', 'tax');
	}
	
	if (self::$db_alter->fetch_table_info('dbtech_vbdonate_donations'))
	{
		self::$db->hide_errors();	
		self::$db->query_write("
			ALTER TABLE " . TABLE_PREFIX . "dbtech_vbdonate_donations ADD netamount DOUBLE( 10, 2 ) NULL AFTER tax"
		);
		self::$db->hide_errors();	
		self::report('Added Row to dbtech_vbdonate_donations', 'netamount');
	}
	
	if (self::$db_alter->fetch_table_info('dbtech_vbdonate_donations'))
	{
		self::$db->hide_errors();	
		self::$db->query_write("
			ALTER TABLE " . TABLE_PREFIX . "dbtech_vbdonate_donations ADD response MEDIUMTEXT NOT NULL AFTER netamount"
		);
		self::$db->hide_errors();	
		self::report('Added Row to dbtech_vbdonate_donations', 'response');
	}
	
	if (self::$db_alter->fetch_table_info('dbtech_vbdonate_donations'))
	{
		$vbulletin->db->query_write(" 
			UPDATE " . TABLE_PREFIX . "dbtech_vbdonate_donations SET netamount = ((amount * 0.971) - 0.30) WHERE amount > 0"
		);
		self::$db->hide_errors();	
		self::report('Altered Table', 'netamount');			
	}
	
	if (self::$db_alter->fetch_table_info('dbtech_vbdonate_donations'))
	{
		$vbulletin->db->query_write(" 
			UPDATE " . TABLE_PREFIX . "dbtech_vbdonate_donations SET fee = amount - ((amount * 0.971) - 0.30) WHERE amount > 0"
		);
		self::$db->hide_errors();	
		self::report('Altered Table', 'fee');			
	}

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>