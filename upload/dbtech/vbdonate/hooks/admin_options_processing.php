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

	if (is_array($settings['dbtech_vbdonate_cantuse']))
	{
  		$settings['dbtech_vbdonate_cantuse'] = implode(',', $settings['dbtech_vbdonate_cantuse']);
	}

	if (is_array($settings['dbtech_vbdonate_canseelist']))
	{
  		$settings['dbtech_vbdonate_canseelist'] = implode(',', $settings['dbtech_vbdonate_canseelist']);
	}

	if (is_array($settings['dbtech_vbdonate_canseebanner']))
	{
  		$settings['dbtech_vbdonate_canseebanner'] = implode(',', $settings['dbtech_vbdonate_canseebanner']);
	}

	if (is_array($settings['dbtech_vbdonate_isadmin']))
	{
  		$settings['dbtech_vbdonate_isadmin'] = implode(',', $settings['dbtech_vbdonate_isadmin']);
	}

	if (is_array($settings['dbtech_vbdonate_donator_usergroup']))
	{
  		$settings['dbtech_vbdonate_donator_usergroup'] = implode(',', $settings['dbtech_vbdonate_donator_usergroup']);
	}

	if (is_array($settings['dbtech_vbdonate_member_view_postbit']))
	{
  		$settings['dbtech_vbdonate_member_view_postbit'] = implode(',', $settings['dbtech_vbdonate_member_view_postbit']);
	}

	if (is_array($settings['dbtech_vbdonate_sideblock_perms']))
	{
  		$settings['dbtech_vbdonate_sideblock_perms'] = implode(',', $settings['dbtech_vbdonate_sideblock_perms']);
	}
	
	if (is_array($settings['dbtech_vbdonate_sideblock_show_on']))
	{
  		$settings['dbtech_vbdonate_sideblock_show_on'] = implode(',', $settings['dbtech_vbdonate_sideblock_show_on']);
	} 
	
	if (is_array($settings['dbtech_vbdonate_cansee_mylist']))
	{
  		$settings['dbtech_vbdonate_cansee_mylist'] = implode(',', $settings['dbtech_vbdonate_cansee_mylist']);
	}
	
	if (is_array($settings['dbtech_vbdonate_anonymous_perms']))
	{
  		$settings['dbtech_vbdonate_anonymous_perms'] = implode(',', $settings['dbtech_vbdonate_anonymous_perms']);
	}
	
	if (is_array($settings['dbtech_vbdonate_disclosed_perms']))
	{
  		$settings['dbtech_vbdonate_disclosed_perms'] = implode(',', $settings['dbtech_vbdonate_disclosed_perms']);
	}
	
	if (is_array($settings['dbtech_vbdonate_no_changegroup']))
	{
  		$settings['dbtech_vbdonate_no_changegroup'] = implode(',', $settings['dbtech_vbdonate_no_changegroup']);
	}
	
	if (is_array($settings['dbtech_vbdonate_no_addgroup']))
	{
  		$settings['dbtech_vbdonate_no_addgroup'] = implode(',', $settings['dbtech_vbdonate_no_addgroup']);
	}							 

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>