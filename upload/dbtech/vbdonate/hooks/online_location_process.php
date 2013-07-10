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

switch($filename)
{
	case 'vbdonate.php':
		switch($values['do'])
		{
			case '':
			case 'contrib_table':
				$userinfo['activity'] = 'dbtech_vbdonate_contrib_table';
				break;
			case 'my_contrib_table':
				$userinfo['activity'] = 'dbtech_vbdonate_my_contrib_table';
				break;				
			case 'donate':
				$userinfo['activity'] = 'dbtech_vbdonate_donate';
				break;
			case 'addon':
			case 'dodonate':
			case 'donate_thanks':
			case 'dbt_vbd_multiupdate':
			case 'dbtech_vbdonate_edit_contrib':
			case 'dbt_vbdeditdo':
				$userinfo['activity'] = 'dbtech_vbdonate_manage';
				break;
		}
}

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>