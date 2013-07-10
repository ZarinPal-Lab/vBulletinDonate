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

	// ####################### START ROTATING BANNER ###########################
if ($vbulletin->options['dbtech_vbdonate_enable'] AND !is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_canseebanner'])) AND !is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_cantuse'])))
		{
			if ($vbulletin->options['dbtech_vbdonate_banner_locs']!='')
			{
				eval('$dbtech_vbdonate_banner_locs = in_array(THIS_SCRIPT, array(misc,' . $vbulletin->options['dbtech_vbdonate_banner_locs'] . '));');
			}
			else
			{
				eval('$dbtech_vbdonate_banner_locs = !in_array(THIS_SCRIPT, array(dbtech_vbdonate));');
			}
			if (in_array(THIS_SCRIPT, array($dbtech_vbdonate_banner_locs)) AND ($vbulletin->options['dbtech_vbdonate_show_banner'] OR $vbulletin->options['dbtech_vbdonate_banner_slider']))
			{						
				$templater = vB_Template::Create('dbtech_vbdonate_banner');
				$templater->register('dbtech_vbdonate_banner', $dbtech_vbdonate_banner);
				$dbtech_vbdonate_banner = $templater->render();

		switch ($vbulletin->options['dbtech_vbdonate_banner_area'])
		{
			case 1: $ad_location['global_below_navbar'] .= $templater->render(); break;
			case 2: $ad_location['ad_navbar_below'] .= $templater->render(); break;
			case 3: $template_hook['forumhome_below_forums'] .= $templater->render(); break;
			case 3: $template_hook['forumhome_belows_forums'] .= $templater->render(); break;
		}
	}		 
}
	// ####################### END ROTATING BANNER #############################	

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/							
?>