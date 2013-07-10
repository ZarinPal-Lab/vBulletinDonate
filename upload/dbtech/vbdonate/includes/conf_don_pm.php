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

//SEND DONATION CONFIRMED PM
	if ($vbulletin->options['dbtech_vbdonate_thankspm_enable'] AND $vbulletin->options['dbtech_vbdonate_pm_enable'] AND (($vbulletin->GPC['dbt_vbd_mdf']=='confirm') OR ($vbulletin->GPC['dbt_vbd_mdf']=='confirmandchangegroup')))
	{
		switch ($vbulletin->options['dbtech_vbdonate_dateformat'])
		{
			case 1: $dbt_vbd_multi_dtformat = 'd-m-y, H:i'; break;
			case 2:	$dbt_vbd_multi_dtformat = 'm-d-y, H:i'; break;
			default: $dbt_vbd_multi_dtformat = 'd-m-y, H:i'; break;
		}
		$dbt_vbd_condons_info = $vbulletin->db->query_read("
			SELECT 
				id, 
				userid, 
				amount, 
				dateline
			FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations AS dbtech_vbdonate_donations
			WHERE id IN($dbt_vbdmultisel) AND userid > 0
		");
		while ($dbt_vbd_condon = $vbulletin->db->fetch_array($dbt_vbd_condons_info))
		{
			if ($dbt_vbd_condon['userid'])
			{
				$pmsender = fetch_userinfo($vbulletin->options['dbtech_vbdonate_pm_sender']);
				$pmreceiver = fetch_userinfo($dbt_vbd_condon['userid']);
				$subject = $vbphrase['dbtech_vbdonate_pmreport_thanks_title'];
				$message = construct_phrase($vbphrase['dbtech_vbdonate_pmreport_thanks_message'],$pmreceiver['username'],vbdate($dbt_vbd_multi_dtformat,$dbt_vbd_condon['dateline']),$vbulletin->options['dbtech_vbdonate_currency'],$dbt_vbd_condon['amount']);
				$pmdm =& datamanager_init('PM', $vbulletin, ERRTYPE_SILENT);
				$pmperms['adminpermissions'] = 2;
				$pmdm->set('fromuserid', $pmsender['userid']);
				$pmdm->set('fromusername', $pmsender['username']);
				$pmdm->set('title', $subject);
				$pmdm->set('message', $message);
				$pmdm->set_recipients($pmreceiver['username'], $pmperms);
				$pmdm->set('dateline', TIMENOW);
				$pmdm->set_info('receipt', false);
				$pmdm->set_info('savecopy', false);
				$pmdm->save();
				unset($pmdm);
			}											
		}
	}
				
/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/				
?>