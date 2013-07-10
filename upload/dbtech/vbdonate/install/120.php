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
			ALTER TABLE " . TABLE_PREFIX . "dbtech_vbdonate_donations ADD disclose TINYINT (2) UNSIGNED NOT NULL DEFAULT '1' AFTER testdon");
		self::$db->hide_errors();	
		self::report('Added Row to table dbtech_vbdonate_donations', 'disclose');
	}

	if (self::$db_alter->fetch_table_info('dbtech_vbdonate_donations'))
	{
		self::$db->hide_errors();	
		self::$db->query_write("
			ALTER TABLE " . TABLE_PREFIX . "dbtech_vbdonate_donations ADD anonymous TINYINT (2) UNSIGNED NOT NULL DEFAULT '0' AFTER disclose");
		self::$db->hide_errors();	
		self::report('Added Row to table dbtech_vbdonate_donations', 'anonymous');
	}

	if (self::$db_alter->fetch_table_info('userfield'))
	{
		self::$db->hide_errors();	
		self::$db->query_write("
			ALTER TABLE " . TABLE_PREFIX . "userfield ADD dbtech_vbdonations_awards MEDIUMTEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ");
		self::report('Added Row to table userfield', 'dbtech_vbdonations_awards');
	}

	if (self::$db_alter->fetch_table_info('dbtech_vbdonate_donations'))
	{
		$dbt_vbd_donid = '';
		$dbt_vbd_dons_info = $vbulletin->db->query_read("
			SELECT 
				dbtech_vbdonate_donations.id, 
				dbtech_vbdonate_donations.userid, 
				dbtech_vbdonate_donations.confirmed
			FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations AS dbtech_vbdonate_donations
				WHERE confirmed = '1'
		");
				while ($dbt_vbd_don = $vbulletin->db->fetch_array($dbt_vbd_dons_info))
				{
					$vbulletin->db->query_write(" UPDATE " . TABLE_PREFIX . "userfield SET dbtech_vbdonations_awards = '1' WHERE userid = '".$dbt_vbd_don[userid]."' ");
				}
		self::report('Adding Awards to Confirmed Contributors','Updated User Awards');				
	}
	
/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 19:30, Fri Nov 25th 2011                                 * >>
<< * VER: 1.0.1                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>