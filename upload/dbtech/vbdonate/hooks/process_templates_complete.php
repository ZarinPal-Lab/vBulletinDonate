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

	// ####################### START PERMISSION CHECKS #########################	
	$vbulletin->options['dbtech_vbdonate_isadmin'] = explode(',', $vbulletin->options['dbtech_vbdonate_isadmin']);
	$vbulletin->options['dbtech_vbdonate_member_view_postbit'] = explode(',', $vbulletin->options['dbtech_vbdonate_member_view_postbit']);
	$vbulletin->options['dbtech_vbdonate_sideblock_perms'] = explode(',', $vbulletin->options['dbtech_vbdonate_sideblock_perms']);
	$vbulletin->options['dbtech_vbdonate_sideblock_show_on'] = explode(',', $vbulletin->options['dbtech_vbdonate_sideblock_show_on']);
	$vbulletin->options['dbtech_vbdonate_anonymous_perms'] = explode(',', $vbulletin->options['dbtech_vbdonate_anonymous_perms']);
	$vbulletin->options['dbtech_vbdonate_disclosed_perms'] = explode(',', $vbulletin->options['dbtech_vbdonate_disclosed_perms']);

	// ####################### END PERMISSION CHECKS ###########################

global $vbulletin, $vbphrase, $template_hook;

if ($vbulletin->options['dbtech_vbdonate_enable'] AND !is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_cantuse'])))
{
	if (THIS_SCRIPT == 'vbdonate')
	{
		$vbulletin->options['selectednavtab'] = 'donate';
	}
	
	if (defined('CMS_SCRIPT') AND !defined('VBDONATE_NAV_LOOPED') AND THIS_SCRIPT != 'vbdonate')
	{
		// vB4 have an awkward design quirk with the Suite, we'll fire the plugin elsewhere
		define('VBDONATE_NAV_LOOPED', true);
		$vbulletin->pluginlist['process_templates_complete'] .= "\r\nrequire(DIR . '/dbtech/vbdonate/hooks/process_templates_complete.php');";
		vBulletinHook::set_pluginlist($vbulletin->pluginlist);
	} else {
	// ####################### START Q-LINKS vB 4.X ############################			
		if (version_compare($vbulletin->versionnumber, '4.2', '<')) 
		{
			if ($vbulletin->options['dbtech_vbdonate_show_ql'] & 1 )
			{	
				$template_hook['navbar_quick_links_menu_pos4'] .= vB_Template::create('dbtech_vbdonate_quicklinks_link')->render();
			}
		
			if ($vbulletin->options['dbtech_vbdonate_show_ql'] & 2 )
			{	
				$template_hook['navbar_community_menu_end'] .= vB_Template::create('dbtech_vbdonate_quicklinks_link')->render();
			}	
		}
	// ####################### END Q-LINKS vB 4.X ##############################		
	}		
}
	// ####################### START TABS vB 4.X ###############################
			if (version_compare($vbulletin->versionnumber, '4.2', '<')) 
			{
				if ($vbulletin->options['dbtech_vbdonate_show_navtab'] AND $vbulletin->options['dbtech_vbdonate_navbar_two'])
				{
					if (is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_canseelist'])))
					{
						$template_hook['navtab_two'] .= vB_Template::create('dbtech_vbdonate_navbar_link')->render();
					} 
					else 
					{
						$template_hook['navtab_two'] .= vB_Template::create('dbtech_vbdonate_navbar_link_nolist')->render();	
					}
				}
			
				if ($vbulletin->options['dbtech_vbdonate_show_navtab'] AND !$vbulletin->options['dbtech_vbdonate_navbar_two'])
				{
					if (is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_canseelist'])))
					{
						$template_hook['navtab_middle'] .= vB_Template::create('dbtech_vbdonate_navbar_link')->render();
					} 
					else 
					{
						$template_hook['navtab_middle'] .= vB_Template::create('dbtech_vbdonate_navbar_link_nolist')->render();	
					}
				}	
			}
	// ####################### END TABS vB 4.X #################################	

	// ####################### START SUBLINKS vB 4.X ###########################				
			if (version_compare($vbulletin->versionnumber, '4.2', '<')) 
			{
				if ($vbulletin->options['dbtech_vbdonate_enable'] AND is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_canseelist'])))
			{
				$template_hook['navbar_end'] .= vB_Template::create('dbtech_vbdonate_subnav_link')->render();			
			} else {
				if ($vbulletin->options['dbtech_vbdonate_enable'] AND !is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_canseelist'])))
				{
				$template_hook['navbar_end'] .= vB_Template::create('dbtech_vbdonate_subnav_link_nolist')->render();
				}
			}
			}
	// ####################### END SUBLINKS vB 4.X #############################
	
	// ####################### START GOAL METER ################################
		if ($vbulletin->options['dbtech_vbdonate_goal_meter_enable'])
	{
		require(DIR . '/dbtech/vbdonate/includes/goal_meter.php');
	}						
	// ####################### END GOAL METER ##################################	

	// ####################### START TAB PERMS vB 4.2 ##########################	
	if (version_compare($vbulletin->versionnumber, '4.2', '>=') AND THIS_SCRIPT !== 'adv_index') 
	{	
		if (!is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_cantuse'])))
		{
    		$show['dbtech_vbdonate_cantuse'] = true;
		}

		if (is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_canseelist'])))
		{
    		$show['dbtech_vbdonate_canseelist'] = true;
		}
		if (!is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_cansee_mylist'])))
		{
    		$show['dbtech_vbdonate_cansee_mylist'] = true;
		}		
	}
	// ####################### END TAB PERMS vB 4.2 ############################
	
	// ####################### START Q-LINKS PERMS vB 4.2 ######################
	if (version_compare($vbulletin->versionnumber, '4.2', '>=') AND THIS_SCRIPT !== 'adv_index') 
	{	
		if ($vbulletin->options['dbtech_vbdonate_show_ql'] & 1  AND is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_canseelist'])))
		{
    		$show['dbtech_vbdonate_qlinks_1'] = true;
		}
		
				if ($vbulletin->options['dbtech_vbdonate_show_ql'] & 2  AND is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_canseelist'])))
		{
    		$show['dbtech_vbdonate_qlinks_2'] = true;
		}
	}
	// ####################### END Q-LINKS PERMS vB 4.2 ########################
	
	// ####################### START FIX BROKEN STYLES #########################
	if ($vbulletin->options['dbtech_vbdonate_sideblock_display'])
	{	
		$vbulletin->templatecache['dbtech_vbdonate_sideblock_bits'] = str_replace('<td>','',$vbulletin->templatecache['dbtech_vbdonate_sideblock_bits']);
		$vbulletin->templatecache['dbtech_vbdonate_sideblock_bits'] = str_replace('</td>','',$vbulletin->templatecache['dbtech_vbdonate_sideblock_bits']);
	}
	// ####################### END FIX BROKEN STYLES ###########################				

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/							
?>