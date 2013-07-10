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

//SWITCH USERGROUPS MANUALLY ADDED DONATIONS
	$dbt_vbd_grouptitle = ($vbulletin->options['dbtech_vbdonate_usergroup_title']);
			
	if ($vbulletin->options['dbtech_vbdonate_usergroup_show'])
	{
		$vbulletin->db->query_write(" 
		UPDATE " . TABLE_PREFIX . "user 
		SET usertitle = 
			'$dbt_vbd_grouptitle' 
		WHERE userid = 
			'".$vbulletin->GPC['userid']."' 
		");
	}									
	if ($vbulletin->options['dbtech_vbdonate_usergroup_type']=='2' AND !is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_no_addgroup'])))
	{
		//ADD USERS RANKS IF ENABLED
		$new_rank = $vbulletin->options['dbtech_vbdonate_postbit_awards_img'];	
		if ($vbulletin->options['dbtech_vbdonate_ranks_enabled'])
		{				
			$vbulletin->db->query_write(" UPDATE " . TABLE_PREFIX . "usertextfield SET rank = '<img src=\"images/ranks/$new_rank\" alt=\"\" border=\"\" />' WHERE usertextfield.userid = '".$vbulletin->GPC['userid']."' ");
		}
		if ($dbt_vbd_newdon['membergroupids']=='')
		{
			$vbulletin->db->query_write(" 
				UPDATE " . TABLE_PREFIX . "user 
				SET membergroupids = 
					".$vbulletin->options['dbtech_vbdonate_donator_usergroup']." 
				WHERE userid = 
					'".$vbulletin->GPC['userid']."' 
			");
		}
		else
		{
			$vbulletin->db->query_write(" 
				UPDATE " . TABLE_PREFIX . "user 
				SET membergroupids = 
					concat(membergroupids,',".$vbulletin->options['dbtech_vbdonate_donator_usergroup']."') 
				WHERE userid = 
					".$vbulletin->GPC['userid']." 
			");
		}
		if ($vbulletin->options['dbtech_vbdonate_usergroup_display'])
		{
			$vbulletin->db->query_write(" 
				UPDATE " . TABLE_PREFIX . "user 
				SET displaygroupid = 
					".$vbulletin->options['dbtech_vbdonate_donator_usergroup']." 
				WHERE userid = 
					'".$vbulletin->GPC['userid']."' 
			");
		}					
	}
	if ($vbulletin->options['dbtech_vbdonate_usergroup_type']=='1' AND !is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_no_changegroup'])))
	{		
		$vbulletin->db->query_write(" 
			UPDATE " . TABLE_PREFIX . "user 
			SET usergroupid = 
				".$vbulletin->options['dbtech_vbdonate_donator_usergroup']." 
			WHERE userid = 
				'".$vbulletin->GPC['userid']."' 
		");
		//ADD USERS RANKS IF ENABLED
		$new_rank = $vbulletin->options['dbtech_vbdonate_postbit_awards_img'];	
		if ($vbulletin->options['dbtech_vbdonate_ranks_enabled'])
		{				
			$vbulletin->db->query_write(" UPDATE " . TABLE_PREFIX . "usertextfield SET rank = '<img src=\"images/ranks/$new_rank\" alt=\"\" border=\"\" />' WHERE usertextfield.userid = '".$vbulletin->GPC['userid']."' ");
		}		
	}

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>