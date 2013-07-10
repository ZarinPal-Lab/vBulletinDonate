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

	$thistime = time();
	echo "<br /><center>Transfering <strong>Donations</strong> From AWcoding Donate To <strong>DragonByte Tech: vBDonate</strong>.</center>";
	vbflush();
	$vbulletin->db->hide_errors();
	$get_awc_dons = $vbulletin->db->query_read("
		SELECT 
			id, 
			userid, 
			mc_gross, 
			payment_date
		FROM " . TABLE_PREFIX . "awc_payments AS awc_payments
		ORDER BY id
	");
	$vbulletin->db->show_errors();

	if ($vbulletin->db->error())
	{
		$get_awc_dons = $vbulletin->db->query_read("
			SELECT 
				id, 
				userid, 
				mc_gross, 
				payment_date
			FROM " . TABLE_PREFIX . "awcl_payments AS awcl_payments
			ORDER BY id
		");
	}

	while ($old_awc_dons = $db->fetch_array($get_awc_dons))
	{
		if ($existing = $db->query_first("
			SELECT id
			FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations
			WHERE userid = '" . $vbulletin->db->escape_string($old_awc_dons['userid']) . "'
			AND dateline = '" . $vbulletin->db->escape_string($old_awc_dons['payment_date']) . "'
		"))
		{
			// Skip this
			continue;
		}
	
		$db->query_write("
			INSERT INTO ".TABLE_PREFIX."dbtech_vbdonate_donations
				(
					userid, 
					amount, 
					dateline, 
					confirmed, 
					userip, 
					testdon
				)
			VALUES 
				(
					'" . $vbulletin->db->escape_string($old_awc_dons['userid']) . "',
					'" . $vbulletin->db->escape_string($old_awc_dons['mc_gross']) . "',
					'" . $vbulletin->db->escape_string($old_awc_dons['payment_date']) . "',
					'1',
					'000.0.0.0',
					'0'
				)
		");
	}
define('CP_REDIRECT', 'vbdonate_banner.php?do=vbdonate_dashboard');
print_stop_message('redirect_dbtech_vbdonate_dons_imported');

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/			
?>