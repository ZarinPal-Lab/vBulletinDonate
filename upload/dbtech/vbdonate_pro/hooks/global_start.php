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

	// ####################### START MODULE TEMPLATE ###########################
	if (THIS_SCRIPT == 'adv_index')
	{
		$vbulletin->options['dbtech_vbdonate_cansee_mylist'] = explode(',', $vbulletin->options['dbtech_vbdonate_cansee_mylist']);
		$vbulletin->options['dbtech_vbdonate_canseelist'] = explode(',', $vbulletin->options['dbtech_vbdonate_canseelist']);
	}	
	if (!is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_cantuse'])))
	{		
		$date = date('Y');
			//require_once(DIR . '/dbtech/vbdonate_pro/actions/widget.php');
			$templater = vB_Template::create('dbtech_vbdonate_adv_portal_donate');
			$templater->register('output', $output);
			$templater->register('date', $date);
			$show['dbtech_vbdonate_adv_portal_donate'] = $templater->render();
	}
	// ####################### END MODULE TEMPLATE #############################		
	
/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>