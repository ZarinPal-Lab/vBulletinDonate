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

//SEND PM TO DONATOR MANUALLY ADDED DONATIONS
	if ($vbulletin->options['dbtech_vbdonate_confirmed_pm_man_enable'] AND $vbulletin->GPC['userid'] AND $vbulletin->options['dbtech_vbdonate_pm_enable'])
	{
		switch ($vbulletin->options['dbtech_vbdonate_dateformat'])
		{
			case 1: $dbt_vbd_addman_dtformat = 'd-m-y, H:i'; break;
			case 2:	$dbt_vbd_addman_dtformat = 'm-d-y, H:i'; break;
			default: $dbt_vbd_addman_dtformat = 'd-m-y, H:i'; break;
		}
			
		$pmsender = fetch_userinfo($vbulletin->options['dbtech_vbdonate_pm_sender']);
		$pmreceiver = fetch_userinfo($vbulletin->GPC['userid']);
				
		if ($vbulletin->GPC['userid'])
		{
			$subject = $vbphrase['dbtech_vbdonate_confirmed_pm_man_title'];
			$message = construct_phrase($vbphrase
				['dbtech_vbdonate_confirmed_pm_man_message'],
				$pmreceiver['username'],
				vbdate($dbt_vbd_addman_dtformat,
				$dbt_vbd_new_dateline),
				$vbulletin->options['dbtech_vbdonate_currency'],
				$vbulletin->GPC['amount'],
				$vbulletin->options['bburl'].'/vbdonate.php?do=my_contrib_table',
				$vbulletin->options['bbtitle']				
			);
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

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>