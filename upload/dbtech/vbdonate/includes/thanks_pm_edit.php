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

//EDITED DONATION THANKS PM
	if (($vbulletin->options['dbtech_vbdonate_thankspm_enable']) AND ($vbulletin->GPC['confirmed']=='1') AND $vbulletin->GPC['userid'] AND $vbulletin->options['dbtech_vbdonate_pm_enable'])
	{
		switch ($vbulletin->options['dbtech_vbdonate_dateformat'])
		{
			case 1: $dbt_vbd_edit_dtformat = 'd-m-y, H:i'; break;
			case 2:	$dbt_vbd_edit_dtformat = 'm-d-y, H:i'; break;
			default: $dbt_vbd_edit_dtformat = 'd-m-y, H:i'; break;
		}
		
		$pmsender = fetch_userinfo($vbulletin->options['dbtech_vbdonate_pm_sender']);
		$pmreceiver = fetch_userinfo($vbulletin->GPC['userid']);
		$subject = $vbphrase['dbtech_vbdonate_pmreport_thanks_title'];
		$message = construct_phrase($vbphrase['dbtech_vbdonate_pmreport_thanks_message'],$pmreceiver['username'],vbdate($dbt_vbd_edit_dtformat,$dbt_vbd_upd_dateline),$vbulletin->options['dbtech_vbdonate_currency'],$vbulletin->GPC['amount']);
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

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>