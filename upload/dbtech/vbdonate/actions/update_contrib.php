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
		
	$vbulletin->input->clean_gpc('r', 'multibit', TYPE_ARRAY);
	$vbulletin->input->clean_gpc('p', 'dbt_vbd_mdf', TYPE_NOHTML);					

	if ($vbulletin->GPC['multibit']!='')
	{
		$vbulletin->db->hide_errors();
		$dbt_vbdmultisel = implode(',', $vbulletin->GPC['multibit']);
			if ($vbulletin->GPC['dbt_vbd_mdf']=='delete')
			{
				$vbulletin->db->query_write(" DELETE FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations WHERE id IN($dbt_vbdmultisel) ");
			}
			if ($vbulletin->GPC['dbt_vbd_mdf']=='confirm')
			{
				$vbulletin->db->query_write(" UPDATE " . TABLE_PREFIX . "dbtech_vbdonate_donations SET confirmed = '1' WHERE id IN($dbt_vbdmultisel) ");							
			}
			if ($vbulletin->GPC['dbt_vbd_mdf']=='unconfirm')
			{
				$vbulletin->db->query_write(" UPDATE " . TABLE_PREFIX . "dbtech_vbdonate_donations SET confirmed = '0' WHERE id IN($dbt_vbdmultisel) ");
			}				
			if ((($vbulletin->GPC['dbt_vbd_mdf']=='changegroup') OR ($vbulletin->GPC['dbt_vbd_mdf']=='confirmandchangegroup')) AND ($vbulletin->options['dbtech_vbdonate_usergroup_type']!='0'))
			{
				$dbt_vbd_targetgroup = trim($vbulletin->options['dbtech_vbdonate_donator_usergroup']);
				$dbt_vbd_grouptitle = ($vbulletin->options['dbtech_vbdonate_usergroup_title']);
					if ($vbulletin->options['dbtech_vbdonate_usergroup_type']=='2')
					{
						require_once(DIR . '/dbtech/vbdonate/includes/add_to_dongroup.php');
					}						
			}
			if ($vbulletin->options['dbtech_vbdonate_usergroup_type']=='1')
			{
				require_once(DIR . '/dbtech/vbdonate/includes/move_to_dongroup.php');
			}
			if ($vbulletin->options['dbtech_vbdonate_confirmed_pm_enable'] AND $vbulletin->options['dbtech_vbdonate_pm_enable'] AND (($vbulletin->GPC['dbt_vbd_mdf']=='confirm') OR ($vbulletin->GPC['dbt_vbd_mdf']=='confirmandchangegroup')))
			{
				require_once(DIR . '/dbtech/vbdonate/includes/confirmed_pm.php');
			}									
			$vbulletin->db->show_errors();	
												
			exec_header_redirect('vbdonate.php?do=contrib_table');
	}																	
/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>