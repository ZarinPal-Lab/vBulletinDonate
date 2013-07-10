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

switch ($userinfo['activity'])
{
	case 'dbtech_vbdonate_contrib_table':
		$handled = true;
		$userinfo['action'] = $vbphrase['dbtech_vbdonate_vbdonate_wol'];
		$userinfo['where'] = '<a href="vbdonate.php?do=contrib_table' . $vbulletin->session->vars['sessionurl_q'] . '">' . $vbphrase['dbtech_vbdonate_vbdonate_wol_contrib_table'] . '</a>';			
		break;
	case 'dbtech_vbdonate_my_contrib_table':
		$handled = true;
		$userinfo['action'] = $vbphrase['dbtech_vbdonate_vbdonate_wol'];
		$userinfo['where'] = '<a href="vbdonate.php?do=contrib_table' . $vbulletin->session->vars['sessionurl_q'] . '">' . $vbphrase['dbtech_vbdonate_vbdonate_wol_contrib_table'] . '</a>';			
		break;		
	case 'dbtech_vbdonate_donate':
		$handled = true;
		$userinfo['action'] = $vbphrase['dbtech_vbdonate_vbdonate_wol'];
		$userinfo['where'] = '<a href="vbdonate.php?do=donate' . $vbulletin->session->vars['sessionurl_q'] . '">' . $vbphrase['dbtech_vbdonate_vbdonate_wol_donate'] . '</a>';			
		break;
	case 'dbtech_vbdonate_manage':
		$handled = true;
		$userinfo['action'] = $vbphrase['dbtech_vbdonate_vbdonate_wol'];
		$userinfo['where'] = '<a href="vbdonate.php?do=donate' . $vbulletin->session->vars['sessionurl_q'] . '">' . $vbphrase['dbtech_vbdonate_vbdonate_wol_manage'] . '</a>';			
		break;
}

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>