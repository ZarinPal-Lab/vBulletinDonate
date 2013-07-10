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

//SEND PM TO STAFF
	if ($vbulletin->options['dbtech_vbdonate_staff_pm_enable'] AND $vbulletin->options['dbtech_vbdonate_pm_enable'])
	{
		$dbt_vbd_newdon_receivers = explode(",", $vbulletin->options['dbtech_vbdonate_pm_receivers']);
			foreach ($dbt_vbd_newdon_receivers AS $dbt_vbd_newdon_receiver)
			{
			if ($vbulletin->userinfo['userid'])
			{
				$pmsender = fetch_userinfo($vbulletin->userinfo['userid']);
				$donatorname = $pmsender['username'];
			}
			else
			{
				$pmsender = fetch_userinfo($vbulletin->options['dbtech_vbdonate_pm_sender']);
				$donatorname = $vbphrase['unregistered'];
			}

			$pmreceiver = fetch_userinfo($dbt_vbd_newdon_receiver);
			$subject = construct_phrase($vbphrase['dbtech_vbdonate_unconf_contrib_staff_pm_title'],$donatorname);
			$message = construct_phrase($vbphrase
				['dbtech_vbdonate_unconf_contrib_staff_pm_message'],
				$donatorname,vbdate($dbt_vbd_addauto_dtformat, TIMENOW), 
				$vbulletin->options['bburl'].'/vbdonate.php?do=contrib_table'
			);
			$pmdm =& datamanager_init('PM', $vbulletin, ERRTYPE_SILENT);
				//$pmperms['adminpermissions'] = 2;
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

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>