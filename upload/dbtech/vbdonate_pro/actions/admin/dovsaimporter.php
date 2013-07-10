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
	{
		$vbulletin->db->hide_errors();
   		echo "<br /><center>Transfering <strong>Donations</strong> From VSa - PayPal Donate To <strong>DragonByte Tech: vBDonate</strong>.</center>";
		vbflush();
		$get_vsa_dons = $vbulletin->db->query_read("
			SELECT 
				id, 
				userid, 
				amount, 
				dateline, 
				confirmed, 
				userip
			FROM " . TABLE_PREFIX . "vsa_ppdonate AS vsa_ppdonate
			ORDER BY id
		");
		while ($old_vsa_dons = $db->fetch_array($get_vsa_dons))
		{
			if ($existing = $db->query_first("
			SELECT id FROM ".TABLE_PREFIX."dbtech_vbdonate_donations 
			WHERE userid = 
				'" . $vbulletin->db->escape_string($old_vsa_dons['userid']) . "' 
			AND dateline = 
				'" . $vbulletin->db->escape_string($old_vsa_dons['dateline']) . "'"))
			{
				// Skip this
				continue;

			}			
			$vbulletin->db->query_write("
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
					'" . $vbulletin->db->escape_string($old_vsa_dons['userid']) . "', 
					'" . $vbulletin->db->escape_string($old_vsa_dons['amount']) . "', 
					'" . $vbulletin->db->escape_string($old_vsa_dons['dateline']) . "', 
					'" . $vbulletin->db->escape_string($old_vsa_dons['confirmed']) . "', 
					'" . $vbulletin->db->escape_string($old_vsa_dons['userip']) . "', '0'
				)
			");
		}
	define('CP_REDIRECT', 'vbdonate_banner.php?do=vbdonate_dashboard');
	print_stop_message('redirect_dbtech_vbdonate_dons_imported');			
	}

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>