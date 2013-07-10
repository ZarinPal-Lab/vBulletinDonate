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

	if ($vbulletin->options['dbtech_vbdonate_enable'] AND !is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_cantuse'])))
	{
	if ($vbulletin->options['dbtech_vbdonate_goal_meter_locs']!='')
			{
				eval('$dbt_vbd_goal_meter_locs = in_array(THIS_SCRIPT, array(misc,' . $vbulletin->options['dbtech_vbdonate_goal_meter_locs'] . '));');
			}
			else
			{
				eval('$dbt_vbd_goal_meter_locs = !in_array(THIS_SCRIPT, array(dbtech_vbdonate));');
			}

			if ($vbulletin->options['dbtech_vbdonate_goal_meter_goal'] > 0 AND in_array(THIS_SCRIPT, array($dbt_vbd_goal_meter_locs)))
			{
				$vbulletin->db->hide_errors();
				
				{
					$dbt_vbd_goalcurr_month = vbdate("m", TIMENOW);
					$dbt_vbd_goalcurr_year = vbdate("y", TIMENOW);
	
					if ($dbt_vbd_goalcurr_month == 1)
					{
						$dbt_vbd_goalstart_month = 12;
						$dbt_vbd_goalstart_year = $dbt_vbd_goalcurr_year - 1;
					}
					else
					{
						$dbt_vbd_goalstart_month = $dbt_vbd_goalcurr_month - 1;
						$dbt_vbd_goalstart_year = $dbt_vbd_goalcurr_year;
					}
				}
				if (!$vbulletin->options['dbtech_vbdonate_goal_meter_goal_amount'] AND (!is_member_of($vbulletin->userinfo,6)))
				{
					switch ($vbulletin->options['dbtech_vbdonate_goal_meter_period'])
				{
					case 1: $dbt_vbd_goal_meter_setperiod = " AND date_format(from_unixtime(dateline),'%m%y') = '".date('my',time())."' "; $vbphrase['dbt_vbd_goal_meter_period'] = $vbphrase['dbtech_vbdonate_goal_received_month_percent']; break;
					case 2: $dbt_vbd_goal_meter_setperiod = " AND date_format(from_unixtime(dateline),'%y') = '".date('y',time())."' "; $vbphrase['dbt_vbd_goal_meter_period'] = $vbphrase['dbtech_vbdonate_goal_received_year_percent']; break;
					default: $dbt_vbd_goal_meter_setperiod = " AND date_format(from_unixtime(dateline),'%m%y') = '".date('my',time())."' "; break;					
                }
			}
				else
				{
					switch ($vbulletin->options['dbtech_vbdonate_goal_meter_period'])
				{
					case 1: $dbt_vbd_goal_meter_setperiod = " AND date_format(from_unixtime(dateline),'%m%y') = '".date('my',time())."' "; $vbphrase['dbt_vbd_goal_meter_period'] = $vbphrase['dbtech_vbdonate_goal_received_month']; break;
					case 2: $dbt_vbd_goal_meter_setperiod = " AND date_format(from_unixtime(dateline),'%y') = '".date('y',time())."' "; $vbphrase['dbt_vbd_goal_meter_period'] = $vbphrase['dbtech_vbdonate_goal_received_year']; break;
					default: $dbt_vbd_goal_meter_setperiod = " AND date_format(from_unixtime(dateline),'%m%y') = '".date('my',time())."' "; break;					
                }
			}												
				if ($vbulletin->options['dbtech_vbdonate_net_amount'])
				{
					$dbt_vbd_getgoal_meter = $vbulletin->db->query_read("
						SELECT netamount
						FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations AS dbtech_vbdonate_donations
						WHERE confirmed = '1' $dbt_vbd_goal_meter_setperiod
					");
				}
				else
				{
					$dbt_vbd_getgoal_meter = $vbulletin->db->query_read("
						SELECT amount
						FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations AS dbtech_vbdonate_donations
						WHERE confirmed = '1' $dbt_vbd_goal_meter_setperiod
					");					
				}				
				while ($dbt_vbd_goal_meter = $vbulletin->db->fetch_array($dbt_vbd_getgoal_meter))
				{
					if ($vbulletin->options['dbtech_vbdonate_net_amount'])
					{
						$dbt_vbd_goal_meter_total += $dbt_vbd_goal_meter[netamount];
					}
					else
					{
						$dbt_vbd_goal_meter_total += $dbt_vbd_goal_meter[amount];	
					}
				}
				if ($dbt_vbd_goal_meter_total=='')
				{
					$dbt_vbd_goal_meter_total = '0';
				}
				$dbt_vbd_goal_meter_goal = $vbulletin->options['dbtech_vbdonate_goal_meter_goal'];
				$dbt_vbd_goal_meter_done = round((($dbt_vbd_goal_meter_total / $dbt_vbd_goal_meter_goal) * 100.2),0);
				$dbt_vbd_goal_meter_left = 100 - $dbt_vbd_goal_meter_done; 

				$templater = vB_Template::create('dbtech_vbdonate_goal_meter');
				$templater->register('dbtech_vbdonate_contrib_table_cansee', $dbtech_vbdonate_contrib_table_cansee);
				$templater->register('admincpdir', $admincpdir);
				$templater->register('contrib_table_cansee', $dbtech_vbdonate);
				if ($vbulletin->options['dbtech_vbdonate_goal_meter_goal_amount'] OR (is_member_of($vbulletin->userinfo,6)))
				{
				$templater->register('dbt_vbd_goal_meter_goal', $dbt_vbd_goal_meter_goal);
				$templater->register('dbt_vbd_goal_meter_total', vb_number_format($dbt_vbd_goal_meter_total, 2));
				}
				$templater->register('dbt_vbd_goal_meter_done', $dbt_vbd_goal_meter_done);
				$templater->register('dbt_vbd_goal_meter_left', $dbt_vbd_goal_meter_left);
				$dbtech_vbdonate_goal_meter = $templater->render();

		switch ($vbulletin->options['dbtech_vbdonate_goal_meter_area'])
		{
			case 1: $ad_location['global_below_navbar'] .= $templater->render(); break;
			case 2: $ad_location['ad_navbar_below'] .= $templater->render(); break;
			case 3: $template_hook['forumhome_below_forums'] .= $templater->render(); break;
		} 					
			$vbulletin->db->show_errors();
		}
}

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>