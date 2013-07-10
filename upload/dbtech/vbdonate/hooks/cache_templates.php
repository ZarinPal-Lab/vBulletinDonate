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

	if ($vbulletin->options['dbtech_vbdonate_enable'])
	{
		$cache = array_merge($cache, array
			(
				'dbtech_vbdonate_donate', 
				'dbtech_vbdonate_contrib_table', 
				'dbtech_vbdonate_contrib_table_bit', 
				'dbtech_vbdonate_contrib_table_edit', 
				'dbtech_vbdonate_goal_meter',
				'dbtech_vbdonate_quicklinks_link',
				'dbtech_vbdonate_navbar_link',
				'dbtech_vbdonate_navbar_link_nolist',
				'dbtech_vbdonate_banner',
				'dbtech_vbdonate_slider',
				'dbtech_vbdonate_my_contrib_table',
				'dbtech_vbdonate_my_contrib_table_bit',
				'dbtech_vbdonate_subnav_link',
				'dbtech_vbdonate_subnav_link_nolist',
				'dbtech_vbdonate_sideblock',
				'dbtech_vbdonate_sideblock_bits',
				'dbtech_vbdonate_sideblock_total',
				'dbtech_vbdonate_postbit_donate',
				'dbtech_vbdonate_goal_meter_sideblock',
				'dbtech_vbdonate_marquee',
				'dbtech_vbdonate_date_time',
				'dbtech_vbdonate_functions',
				'dbtech_vbdonate_contrib_table_unc',
				'dbtech_vbdonate_contrib_table_unc_bit',
				'dbtech_vbdonate_contrib_table_anon',
				'dbtech_vbdonate_contrib_table_anon_bit',
				'dbtech_vbdonate_contrib_table_undisc',
				'dbtech_vbdonate_contrib_table_undisc_bit',
				'dbtech_vbdonate_request_conf',
				'dbtech_vbdonate_request_conf_option',
				'adv_portal_donate',
				'dbtech_vbdonate_adv_portal_donate',
				'dbtech_vbdonate_countdown',
				'dbtech_vbdonate_total_contribs',
				'dbtech_vbdonate_total_contribs_user'			
			)
		);
	}	

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>