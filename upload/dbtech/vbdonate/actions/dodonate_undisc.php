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
//if (!is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_cantuse'])))
//{
	if (($_REQUEST['do'] == 'dodonate_undisc') AND is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_cantuse'])))
	{
		eval(standard_error($vbulletin->options['dbtech_vbdonate_cantuse_reason']));
	}	
	$vbulletin->input->clean_array_gpc('p', array
		(
			'disclose' => TYPE_UINT,
			'anonymous' => TYPE_UINT,
		)
	);

	$vbulletin->input->clean_gpc('p', 'amount', TYPE_NOHTML);

	if(strstr($vbulletin->GPC['amount'],'|'))
	{
		$dbt_vbd_donate_params = explode('|', $vbulletin->GPC['amount']); 
		$dbt_vbd_donate_amount = $dbt_vbd_donate_params[0];
		$dbt_vbd_donate_subs = $dbt_vbd_donate_params[1];
	}
	else
	{
	$dbt_vbd_donate_amount = $vbulletin->GPC['amount'];
		$dbt_vbd_donate_subs = 0;
	}

	switch ($vbulletin->options['dbtech_vbdonate_dateformat'])
	{
		case 1: $dbt_vbd_addauto_dtformat = 'd-m-y, H:i'; break;
		case 2:	$dbt_vbd_addauto_dtformat = 'm-d-y, H:i'; break;
		default: $dbt_vbd_addauto_dtformat = 'd-m-y, H:i'; break;
	}						

	$fee = $vbulletin->GPC['amount'] - (($vbulletin->GPC['amount'] * 0.971) - 0.30);
	$netamount = (($vbulletin->GPC['amount'] * 0.971) - 0.30);

	$db->query_write("
		INSERT INTO `". TABLE_PREFIX ."dbtech_vbdonate_donations`
			(
				userid, 
				amount,
				fee,
				tax,
				netamount, 
				dateline, 
				confirmed, 
				userip, 
				testdon,
				disclose,
				anonymous
			)
			VALUES 
			(
				" . $vbulletin->userinfo['userid'] . ",
				'" . $db->escape_string($dbt_vbd_donate_amount) . "',
				'" . $fee . "',
				'0.00',
				'" . $netamount . "',
				" . TIMENOW . ",
				'0',
				'" . IPADDRESS . "',
				'" . ($vbulletin->options['dbtech_vbdonate_sandbox_enable'] ? '1' : '0') . "',
				'1',
				".$vbulletin->GPC['anonymous']."
			)
		");	
				
			$donation_data['donations_id'] = $db->insert_id();		

	if ($vbulletin->options['dbtech_vbdonate_unconf_contrib_pm_user'] AND $vbulletin->userinfo['userid'] AND $vbulletin->options['dbtech_vbdonate_pm_enable'])
	{
		require_once(DIR . '/dbtech/vbdonate/includes/unconf_contrib_pm_user.php');
	}			
	if ($vbulletin->options['dbtech_vbdonate_staff_pm_enable'] AND $vbulletin->options['dbtech_vbdonate_pm_enable'])
	{
		require_once(DIR . '/dbtech/vbdonate/includes/staff_pm.php');
	}
	if ($vbulletin->options['dbtech_vbdonate_sandbox_enable'])
	{				
		$dbt_vbd_ppurl = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_xclick';
	}
	else 
	{
		$dbt_vbd_ppurl = 'https://www.paypal.com/cgi-bin/webscr?cmd=_xclick';
	}
		$dbt_vbd_ppurl .= '&amount='.$vbulletin->GPC['amount'];
		
	if ($vbulletin->options['dbtech_vbdonate_sandbox_enable'])
	{				
		$dbt_vbd_ppurl .= '&business='.$vbulletin->options['dbtech_vbdonate_sandbox_email'];
	} 
	else 
	{
		$dbt_vbd_ppurl .= '&business='.$vbulletin->options['dbtech_vbdonate_email'];
	}
		$dbt_vbd_ppurl .= '&currency_code='.$vbulletin->options['dbtech_vbdonate_currency'];
		$dbt_vbd_ppurl .= '&item_number=' . $donation_data['donations_id'];
		$dbt_vbd_ppurl .= '&item_name='.construct_phrase($vbphrase['dbtech_vbdonate_pp_summary'], $vbulletin->options['bbtitle']).' ('.$vbphrase['user'].': '.$vbulletin->userinfo['username'].')';
		$dbt_vbd_ppurl .= '&tax=0';
		$dbt_vbd_ppurl .= '&shipping=0';
		$dbt_vbd_ppurl .= '&no_shipping=1';
	if (($vbulletin->options['dbtech_vbdonate_ppimage_enable']) AND ($vbulletin->options['dbtech_vbdonate_ppimage']!='http://'))
	{
		$dbt_vbd_ppurl .= '&cpp_header_image='.$vbulletin->options['dbtech_vbdonate_ppimage'];
	}
	if (file_exists(DIR . '/dbtech/vbdonate_pro/actions/admin/content.php'))
	{
		$dbt_vbd_ppurl .= '&notify_url='.$vbulletin->options['bburl'].'/vbdonate_gateway.php';
	}
		$dbt_vbd_ppurl .= '&return='.$vbulletin->options['bburl'].'/vbdonate.php?do=contribute_thanks';

		exec_header_redirect($dbt_vbd_ppurl);
//}
/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 19:30, Wed Apr 18th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/

?>