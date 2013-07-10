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

	$vbulletin->input->clean_array_gpc('p', array
		(
			'userid' => TYPE_UINT,
			'amount' => TYPE_NOHTML,
			'dateline_m' => TYPE_UINT,
			'dateline_d' => TYPE_UINT,
			'dateline_y' => TYPE_UINT,
			'userip' => TYPE_NOHTML,
			'testdon' => TYPE_UINT,
			'disclose' => TYPE_UINT,
			'anonymous' => TYPE_UINT,			
			'changegroup' => TYPE_UINT
		)
	);
			
	if ($vbulletin->GPC['dateline_m'] AND $vbulletin->GPC['dateline_d'] AND $vbulletin->GPC['dateline_y'])
	{
		$dbt_vbd_new_dateline = mktime(0, 0, 0, $vbulletin->GPC['dateline_m'], $vbulletin->GPC['dateline_d'], $vbulletin->GPC['dateline_y']);
	}
	else
	{
		$dbt_vbd_new_dateline = TIMENOW;
	}

	if ($vbulletin->GPC['userid']=='')
	{
		$vbulletin->GPC['userid'] = '0';
	}	
	if ($vbulletin->GPC['amount']=='')
	{
		$vbulletin->GPC['amount'] = '0';
	}
	if ($vbulletin->GPC['userip']=='')
	{
		$vbulletin->GPC['userip'] = '000.0.0.0';
	}
	if ($vbulletin->GPC['testdon']=='')
	{
		$vbulletin->GPC['testdon'] = '0';
	}
	if ($vbulletin->GPC['disclose']=='')
	{
		$vbulletin->GPC['disclose'] = '0';
	}
	if ($vbulletin->GPC['anonymous']=='')
	{
		$vbulletin->GPC['anonymous'] = '0';
	}											

	$vbulletin->db->hide_errors();
	$vbulletin->db->sql_prepare($userip);
	$vbulletin->db->query_write("
		INSERT INTO `". TABLE_PREFIX ."dbtech_vbdonate_donations`
		(
			userid, 
			amount,
			dateline, 
			confirmed, 
			userip,
			testdon,
			disclose,
			netamount,
			fee,
			anonymous
		)
		VALUES 
		(
			".$vbulletin->GPC['userid'].", 
			".$vbulletin->GPC['amount'].", 
			".$dbt_vbd_new_dateline.", 
			'1', 
			".$vbulletin->db->sql_prepare($vbulletin->GPC['userip']).", 
			".$vbulletin->GPC['testdon'].",
			".$vbulletin->GPC['disclose'].",
			((amount * 0.971) - 0.30),
			amount - ((amount * 0.971) - 0.30),
			".$vbulletin->GPC['anonymous']."
		)
	");

	$dbt_vbd_newdon = fetch_userinfo($vbulletin->GPC['userid']);

	if ($dbt_vbd_newdon['membergroupids']=='')
	{
		$dbt_vbd_newdon_membership = array($dbt_vbd_newdon['usergroupid']);
	}
	else
	{
		$dbt_vbd_newdon_membership = array($dbt_vbd_newdon['membergroupids']);
	}

	if (($vbulletin->options['dbtech_vbdonate_usergroup_type']!='0') AND ($dbt_vbd_newdon['usergroupid']!=$vbulletin->options['dbtech_vbdonate_donator_usergroup']) AND !in_array($vbulletin->options['dbtech_vbdonate_donator_usergroup'],$dbt_vbd_newdon_membership) AND ($vbulletin->GPC['changegroup']=='1'))
	{
	require_once(DIR . '/dbtech/vbdonate/includes/switch_groups_man.php');				
	}	

	$vbulletin->db->show_errors();			

	if ($vbulletin->options['dbtech_vbdonate_thankspm_man_enable'] AND $vbulletin->GPC['userid'] AND $vbulletin->options['dbtech_vbdonate_pm_enable'])
	{
		require_once(DIR . '/dbtech/vbdonate/includes/thanks_pm_man.php');
	}
	
$dbt_vbd_donid = '';
				//UPDATE USER AWARDS
				$dbt_vbd_dons_info = $vbulletin->db->query_read("
					SELECT id, userid, confirmed, amount
					FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations
					WHERE confirmed = '1'
				");
				while ($dbt_vbd_don = $vbulletin->db->fetch_array($dbt_vbd_dons_info))
				{
					$vbulletin->db->query_write(" UPDATE " . TABLE_PREFIX . "userfield SET dbtech_vbdonations_awards = '1' WHERE userid = '".$dbt_vbd_don[userid]."' ");			
				}								

	exec_header_redirect('vbdonate.php?do=contrib_table');

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>