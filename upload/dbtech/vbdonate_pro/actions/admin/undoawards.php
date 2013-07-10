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

//REMOVE ALL AWARDS
$dbt_vbd_donid = '';
				$dbt_vbd_dons_info = $vbulletin->db->query_read("
					SELECT dbtech_vbdonate_donations.id, dbtech_vbdonate_donations.userid, dbtech_vbdonate_donations.confirmed
					FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations AS dbtech_vbdonate_donations
				");
				while ($dbt_vbd_don = $vbulletin->db->fetch_array($dbt_vbd_dons_info))
				{
					$vbulletin->db->query_write(" UPDATE " . TABLE_PREFIX . "userfield SET dbtech_vbdonations_awards = '' WHERE userid = '".$dbt_vbd_don[userid]."' ");
				}
define('CP_REDIRECT', 'index.php?');
print_stop_message('redirect_dbtech_vbdonate_awards_updates');

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>