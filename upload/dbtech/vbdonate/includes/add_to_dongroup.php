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
$vbulletin->options['dbtech_vbdonate_no_addgroup'] = explode(',', $vbulletin->options['dbtech_vbdonate_no_addgroup']);
//ADD USERS TO THE DONATOR GROUP = ADDITIONAL USERGROUPS
	if ($vbulletin->options['dbtech_vbdonate_usergroup_type']=='2' AND !is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_no_addgroup'])))
	{
		$dbt_vbd_verifygroup = "AND user.membergroupids NOT LIKE '%$dbt_vbd_targetgroup%'";
	}
	$dbt_vbd_dons_info = $vbulletin->db->query_read("
		SELECT 
			dbtech_vbdonate_donations.id, 
		 	dbtech_vbdonate_donations.userid, 
		 	user.usergroupid, 
		 	user.membergroupids						
		FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations AS dbtech_vbdonate_donations
		LEFT JOIN " . TABLE_PREFIX . "user AS user ON (dbtech_vbdonate_donations.userid = user.userid)
		WHERE dbtech_vbdonate_donations.id IN($dbt_vbdmultisel) AND dbtech_vbdonate_donations.userid > 0 AND user.usergroupid != '".$dbt_vbd_targetgroup."' 
	");
	
	while ($dbt_vbd_don = $vbulletin->db->fetch_array($dbt_vbd_dons_info))
	{
	$dbt_vbd_donid .= ','.$dbt_vbd_don[userid];

		if ($vbulletin->options['dbtech_vbdonate_usergroup_type']=='2')
		{
			if (!is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_no_addgroup'])))
			{
			if ($dbt_vbd_don[membergroupids]=='')
			{
				$vbulletin->db->query_write(" UPDATE " . TABLE_PREFIX . "user SET membergroupids = ".$dbt_vbd_targetgroup." WHERE userid = '".$dbt_vbd_don[userid]."' $dbt_vbd_verifygroup ");
			}
			else
			{
				$vbulletin->db->query_write(" UPDATE " . TABLE_PREFIX . "user SET membergroupids = concat(membergroupids,',".$dbt_vbd_targetgroup."') WHERE userid = '".$dbt_vbd_don[userid]."' $dbt_vbd_verifygroup ");
			}			
			if ($vbulletin->options['dbtech_vbdonate_usergroup_display'])
			{
				$vbulletin->db->query_write(" UPDATE " . TABLE_PREFIX . "user SET displaygroupid = ".$dbt_vbd_targetgroup." WHERE userid = '".$dbt_vbd_don[userid]."' ");
			}							
			if ($vbulletin->options['dbtech_vbdonate_usergroup_show'])
			{
				$vbulletin->db->query_write(" UPDATE " . TABLE_PREFIX . "user SET usertitle = '$dbt_vbd_grouptitle' WHERE userid = '".$dbt_vbd_don[userid]."' ");
			}
		}
			if ($vbulletin->GPC['dbt_vbd_mdf']=='confirmandchangegroup')
			{
				$vbulletin->db->query_write(" UPDATE " . TABLE_PREFIX . "dbtech_vbdonate_donations SET confirmed = '1' WHERE id IN($dbt_vbdmultisel) ");
			}
			//ADD USERS RANKS IF ENABLED
			$new_rank = $vbulletin->options['dbtech_vbdonate_postbit_awards_img'];
				if ($vbulletin->GPC['dbt_vbd_mdf']=='confirmandchangegroup')
				{
					$vbulletin->db->query_write(" UPDATE " . TABLE_PREFIX . "dbtech_vbdonate_donations SET confirmed = '1' WHERE id IN($dbt_vbdmultisel) ");
						if ($vbulletin->options['dbtech_vbdonate_ranks_enabled'])
						{				
							$vbulletin->db->query_write(" UPDATE " . TABLE_PREFIX . "usertextfield SET rank = '<img src=\"images/ranks/$new_rank\" alt=\"\" border=\"\" />' WHERE usertextfield.userid = '".$dbt_vbd_don[userid]."' ");
						}
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