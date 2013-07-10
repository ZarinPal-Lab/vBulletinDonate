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
	unset($dbt_foot_str);				
if ($vbulletin->options['dbtech_vbdonate_enable'])
{
	// Copyright
	if ($vbulletin->options['dbtech_vbdonate_branding_free'] != '<(-=vBDonate.Key.Branding.Free=-)>')
	{
		if (file_exists(DIR . '/dbtech/vbdonate_pro/actions/admin/content.php'))
		{
			$dbt_foot_str .= 'Donation System provided by '. 'vBDonate (Pro)';
			
			if ($vbulletin->options['dbtech_vbdonate_displayversion'])
			{
				$dbt_foot_str .= ' v1.4.1 (PRO)';
			}

			$dbt_foot_str .=  ' - vBulletin Mods & Addons. Copyright &copy; ' . date('Y') . ' DragonByte Technologies Ltd.';
			
		} else {
			$dbt_foot_str .= 'Donation System provided by '. 'vBDonate (Lite)';
			
			if ($vbulletin->options['dbtech_vbdonate_displayversion'])
			{
				$dbt_foot_str .= ' v1.4.1 (LITE)';
			}
            if ($vbulletin->options['dbtech_vbdonate_displayhivelocity'])
			{
				$dbt_foot_str .= ' Runs best on HiVelocity Hosting.';
			}
			$dbt_foot_str .=  ' - vBulletin Mods & Addons. Copyright &copy; ' . date('Y') . ' DragonByte Technologies Ltd.';
		}

		$vbulletin->options['copyrighttext'] = ($vbulletin->options['copyrighttext'] != '' ? $dbt_foot_str . '<br />' . $vbulletin->options['copyrighttext'] : $dbt_foot_str);
	}
}
	unset($dbt_foot_str);
/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 19:30, Fri Nov 25th 2011                                 * >>
<< * VER: 1.0.1                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/

?>