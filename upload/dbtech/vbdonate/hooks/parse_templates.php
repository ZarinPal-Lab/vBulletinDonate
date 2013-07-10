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

	// ####################### START SHOW SLIDER ###############################
	/*$date = date('Y');
		require_once(DIR . '/dbtech/vbdonate_pro/actions/widget.php');
		$templater = vB_Template::create('dbtech_vbdonate_slider');
		$templater->register('output', $output);
		$templater->register('date', $date);
		$show['dbtech_vbdonate_slider'] = $templater->render();*/
	// ####################### END SHOW SLIDER #################################
	
	// ####################### START INSERT FUNCTIONS ##########################			
	$date = date('Y');
		//require_once(DIR . '/dbtech/vbdonate_pro/actions/widget.php');
		$templater = vB_Template::create('dbtech_vbdonate_functions');
		$templater->register('output', $output);
		$templater->register('date', $date);
		$show['dbtech_vbdonate_functions'] = $templater->render();
	// ####################### END INSERT FUNCTIONS ############################
			
	// ####################### START DATE/TIME #################################			
	$date = date('Y');
		//require_once(DIR . '/dbtech/vbdonate_pro/actions/widget.php');
		$templater = vB_Template::create('dbtech_vbdonate_date_time');
		$templater->register('output', $output);
		$templater->register('date', $date);
		$show['dbtech_vbdonate_date_time'] = $templater->render();
	// ####################### END DATE/TIME ###################################	
					
	// ####################### START GOAL METER FOR SIDEBLOCKS #################					
	if ($vbulletin->options['dbtech_vbdonate_enable'] AND !is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_cantuse'])))
	{
		if ((THIS_SCRIPT == 'adv_index') || (THIS_SCRIPT == 'index'))
		{
			if ($vbulletin->options['dbtech_vbdonate_goal_meter_goal'] > 0 )
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
						$dbt_vbd_goal_meter_total_block += $dbt_vbd_goal_meter[netamount];
					}
					else
					{
						$dbt_vbd_goal_meter_total_block += $dbt_vbd_goal_meter[amount];	
					}					
				}
				if ($dbt_vbd_goal_meter_total_block=='')
				{
					$dbt_vbd_goal_meter_total_block = '0';
				}
				$dbt_vbd_goal_meter_goal_block = $vbulletin->options['dbtech_vbdonate_goal_meter_goal'];
				$dbt_vbd_goal_meter_done_block = round((($dbt_vbd_goal_meter_total_block / $dbt_vbd_goal_meter_goal_block) * 100.2), 0);
				$dbt_vbd_goal_meter_left = 100 - $dbt_vbd_goal_meter_done_block;
					
			$vbulletin->db->show_errors();
		}
		
	$date = date('Y');
		$templater = vB_Template::create('dbtech_vbdonate_goal_meter_sideblock');
		$templater->register('output', $output);
		$templater->register('date', $date);
		if ($vbulletin->options['dbtech_vbdonate_goal_meter_goal_amount'] OR (is_member_of($vbulletin->userinfo,6)))
		{
		$templater->register('dbt_vbd_goal_meter_goal_block', $dbt_vbd_goal_meter_goal_block);
		$templater->register('dbt_vbd_goal_meter_total_block', vb_number_format($dbt_vbd_goal_meter_total_block,2));
		}
		$templater->register('dbt_vbd_goal_meter_done_block', $dbt_vbd_goal_meter_done_block);
		$templater->register('dbt_vbd_goal_meter_left', $dbt_vbd_goal_meter_left);
		$show['dbtech_vbdonate_goal_meter_sideblock'] = $templater->render();		
		
		}
	}
	// ####################### END GOAL METER FOR SIDEBLOCKS ###################
	
	// ####################### START TOTAL CONTRIBS GOAL METER #################			
	global $db, $vbulletin;
	
	if ($vbulletin->options['dbtech_vbdonate_net_amount'])
	{
		$totalcontribs = $vbulletin->db->query_read("
			SELECT SUM(netamount) AS TotalAmount
			FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations
			WHERE confirmed=1
		");  
	}
	else
	{
		$totalcontribs = $vbulletin->db->query_read("
			SELECT SUM(amount) AS TotalAmount
			FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations
			WHERE confirmed=1
		");  				
	}            
		while ($array = $vbulletin->db->fetch_array($totalcontribs))
		{
			$post['total_amount'] = $array['TotalAmount'];
		} 
		
// if  $post['amount'] is the variable that holds the number formatted amount they donated

switch ($vbulletin->options['dbtech_vbdonate_currency'])
{
	case 'USD':
	case 'AUD':
	case 'CAD':
	case 'HKD':
	case 'MXN':
	case 'NZD':
	case 'SGD':
		 $post['amount'] = '$' .  $post['amount'];
		break;

	case 'BRL':
		 $post['amount'] = 'R$' .  $post['amount'];
		break;

	case 'CZK':
		 $post['amount'] = 'K&#269;' .  $post['amount'];
		break;

	case 'DKK':
	case 'SEK':
	case 'NOK':
		 $post['amount'] .=  $post['amount'] . ' kr';
		break;

	case 'EUR':
		 $post['amount'] = '&euro;' .  $post['amount'];
		break;

	case 'HUF':
		 $post['amount'] = 'Ft ' .  $post['amount'];
		break;

	case 'ILS':
		 $post['amount'] = '&#8362;' .  $post['amount'];
		break;

	case 'JPY':
		 $post['amount'] = '&yen;' .  $post['amount'];
		break;

	case 'MYR':
		 $post['amount'] = 'RM ' .  $post['amount'];
		break;

	case 'PHP':
		 $post['amount'] = '&#8369;' .  $post['amount'];
		break;

	case 'GBP':
		 $post['amount'] = '&pound;' .  $post['amount'];
		break;

	case 'CHF':
		 $post['amount'] = 'CHF ' .  $post['amount'];
		break;

	case 'THB':
		 $post['amount'] = '&#3647;' .  $post['amount'];
		break;

	case 'TWD':
		 $post['amount'] = 'NT$' .  $post['amount'];
		break;

	case 'TRY':
		 $post['amount'] = '&#8356;' .  $post['amount'];
		break;
}		
		 
		$templater = vB_Template::create('dbtech_vbdonate_total_contribs');
		$templater->register('post', $post);					
	
		$date = date('Y');
			//require_once(DIR . '/dbtech/vbdonate_pro/actions/widget.php');
			$templater = vB_Template::create('dbtech_vbdonate_total_contribs');
			$templater->register('output', $output);
			$templater->register('date', $date);
			$templater->register('post', $post);
			$show['dbtech_vbdonate_total_contribs'] = $templater->render();
	// ####################### END TOTAL CONTRIBS GOAL METER ###################
							
	// ####################### START DISPLAY MARQUEE ###########################
	$date = date('Y');
		//require_once(DIR . '/dbtech/vbdonate_pro/actions/widget.php');
		$templater = vB_Template::create('dbtech_vbdonate_marquee');
		$templater->register('output', $output);
		$templater->register('date', $date);
		$show['dbtech_vbdonate_marquee'] = $templater->render();
	// ####################### END DISPLAY MARQUEE #############################
														
/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>