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

	$vbulletin->db->hide_errors();
	$vbulletin->input->clean_array_gpc('p', array
		(
			'id' => TYPE_UINT,
			'userid' => TYPE_UINT,
			'amount' => TYPE_NOHTML,
			'dateline_h' => TYPE_UINT,
			'dateline_i' => TYPE_UINT,
			'dateline_s' => TYPE_UINT,
			'dateline_m' => TYPE_UINT,
			'dateline_d' => TYPE_UINT,
			'dateline_y' => TYPE_UINT,
			'userip' => TYPE_NOHTML,
			'testdon' => TYPE_NOHTML,
			'confirmed' => TYPE_UINT,
			'disclose' => TYPE_UINT,
			'anonymous' => TYPE_UINT,
			'changegroup' => TYPE_UINT
		)
	);
	$vbulletin->db->sql_prepare($userip);
	$dbt_vbd_upd_dateline = mktime
	(
		$vbulletin->GPC['dateline_h'], 
		$vbulletin->GPC['dateline_i'], 
		$vbulletin->GPC['dateline_s'], 
		$vbulletin->GPC['dateline_m'], 
		$vbulletin->GPC['dateline_d'], 
		$vbulletin->GPC['dateline_y'], 
		-1
	);

	if ($vbulletin->GPC['confirmed']=='1')
	{
		$dbt_vbd_confirmed = '1';
	}
	else
	{
		$dbt_vbd_confirmed = '0';
	}
			
	if ($vbulletin->GPC['testdon']=='1')
	{
		$dbt_vbd_testdon = '1';
	}
	else
	{
		$dbt_vbd_testdon = '0';
	}
	
	if ($vbulletin->GPC['disclose']=='1')
	{
		$dbt_vbd_disclose = '1';
	}
	else
	{
		$dbt_vbd_disclose = '0';
	}
			
	if ($vbulletin->GPC['anonymous']=='1')
	{
		$dbt_vbd_anonymous = '1';
	}
	else
	{
		$dbt_vbd_anonymous = '0';
	}								

	$vbulletin->db->query_write(" 
		UPDATE " . TABLE_PREFIX . "dbtech_vbdonate_donations SET 
			amount = '".$vbulletin->GPC['amount']."', 
			dateline = '".$dbt_vbd_upd_dateline."',  
			userip = '".$vbulletin->GPC['userip']."', 
			testdon = '".$vbulletin->GPC['testdon']."', 
			confirmed = '".$dbt_vbd_confirmed."',
			disclose = '".$vbulletin->GPC['disclose']."',
			anonymous = '".$vbulletin->GPC['anonymous']."' 
			WHERE id = '".$vbulletin->GPC['id']."' 
		");

	$vbulletin->db->show_errors();

	if (($vbulletin->options['dbtech_vbdonate_thankspm_enable']) AND ($vbulletin->GPC['confirmed']=='1') AND $vbulletin->GPC['userid'] AND $vbulletin->options['dbtech_vbdonate_pm_enable'])
	{
		require_once(DIR . '/dbtech/vbdonate/includes/thanks_pm_edit.php');				
	}
	//UPDATE FEE AND NET AMOUNT
		$dbt_vbd_setfees = $vbulletin->db->query_read("
			SELECT id, userid, confirmed, netamount 
			FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations
			WHERE id = '".$vbulletin->GPC['id']."'
		");
			while ($dbt_vbd_don = $vbulletin->db->fetch_array($dbt_vbd_setfees))
			{
				$vbulletin->db->query_write(" 
					UPDATE " . TABLE_PREFIX . "dbtech_vbdonate_donations SET 
						netamount = ((amount * 0.971) - 0.30), 
						fee = amount - ((amount * 0.971) - 0.30)
				");			
			}	

	exec_header_redirect('vbdonate.php?do=contrib_table');

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>