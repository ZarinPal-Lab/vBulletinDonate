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

// ####################### START POSTBIT AWARDS AUTO ########################################
	if ($this->registry->options["dbtech_vbdonate_postbit_awards_enable"] AND !$this->registry->options["dbtech_vbdonate_manual_award_place"])
	{				
		$dbt_vbd_donid = '';
		global $db, $vbulletin;
		$dbt_vbd_dons_info = $vbulletin->db->query_read("
			SELECT dbtech_vbdonations_awards, userid
			FROM " . TABLE_PREFIX . "userfield
			WHERE userid = '".$post[userid]."' 
		");										
		while ($dbt_vbd_don = $vbulletin->db->fetch_array($dbt_vbd_dons_info))
		{
			if ($vbulletin->condition = $post[dbtech_vbdonations_awards] == '1')
			{
				if ($this->registry->options["dbtech_vbdonate_award_center"])
				{
				global $vbphrase, $vbulletin, $bbuserinfo;
				$sess = $vbulletin->session->vars['sessionurl_q'];
				$template_hook['postbit_userinfo_left'] .= '
				<br /><center><img src="dbtech/vbdonate_pro/images/awards/' . $this->registry->options[dbtech_vbdonate_postbit_awards_img] . '"></center><br /><br />
				';
				} else {
				global $vbphrase, $vbulletin, $bbuserinfo;
				$sess = $vbulletin->session->vars['sessionurl_q'];
				$template_hook['postbit_userinfo_left'] .= '
				<br /><img src="dbtech/vbdonate_pro/images/awards/' . $this->registry->options[dbtech_vbdonate_postbit_awards_img] . '"><br /><br />
				';				
				}	
			}
		}
	}
// ####################### END POSTBIT AWARDS AUTO ##########################################
// ####################### START POSTBIT AWARDS MANUAL ######################################
	if ($this->registry->options["dbtech_vbdonate_manual_award_place"])
	{					
		$date = date('Y');
			//require_once(DIR . '/dbtech/vbdonate_pro/actions/widget.php');
			$templater = vB_Template::create('dbtech_vbdonate_postbit_award');
			$templater->register('output', $output);
			$templater->register('date', $date);
			$show['dbtech_vbdonate_postbit_award'] = $templater->render();										
	}
// ####################### END POSTBIT AWARDS MANUAL ########################################	
// ####################### START POSTBIT CONTRIBUTIONS AUTO #################################
	if ($this->registry->options["dbtech_vbdonate_show_postbit_contribs"])
	{
		if ($this->post['userid'])
        {
			if ($this->registry->options['dbtech_vbdonate_net_amount'])
			{        	
    		global $db, $vbulletin;
				$userdon = $db->query_read("
					SELECT userid, SUM(netamount) AS TotalAmount
                    FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations
                    WHERE (userid = ".$this->post['userid'].") AND confirmed=1 AND disclose=1
                    GROUP BY userid
				");
			}
			else
			{
    		global $db, $vbulletin;
				$userdon = $db->query_read("
					SELECT userid, SUM(amount) AS TotalAmount
                    FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations
                    WHERE (userid = ".$this->post['userid'].") AND confirmed=1 AND disclose=1
                    GROUP BY userid
				");				
			}              
                    while ($array = $db->fetch_array($userdon))
                        {
                        	$post['total_amount'] = $array['TotalAmount'];
                        }
						
// if   $post['currency'] is the variable that holds the number formatted amount they donated

switch ($vbulletin->options['dbtech_vbdonate_currency'])
{
	case 'USD':
	case 'AUD':
	case 'CAD':
	case 'HKD':
	case 'MXN':
	case 'NZD':
	case 'SGD':
		  $post['currency'] = '$' .   $post['currency'];
		break;

	case 'BRL':
		  $post['currency'] = 'R$' .   $post['currency'];
		break;

	case 'CZK':
		  $post['currency'] = 'K&#269;' .   $post['currency'];
		break;

	case 'DKK':
	case 'SEK':
	case 'NOK':
		  $post['currency'] .=   $post['currency'] . ' kr';
		break;

	case 'EUR':
		  $post['currency'] = '&euro;' .   $post['currency'];
		break;

	case 'HUF':
		  $post['currency'] = 'Ft ' .   $post['currency'];
		break;

	case 'ILS':
		  $post['currency'] = '&#8362;' .   $post['currency'];
		break;

	case 'JPY':
		  $post['currency'] = '&yen;' .   $post['currency'];
		break;

	case 'MYR':
		  $post['currency'] = 'RM ' .   $post['currency'];
		break;

	case 'PHP':
		  $post['currency'] = '&#8369;' .   $post['currency'];
		break;

	case 'GBP':
		  $post['currency'] = '&pound;' .   $post['currency'];
		break;

	case 'CHF':
		  $post['currency'] = 'CHF ' .   $post['currency'];
		break;

	case 'THB':
		  $post['currency'] = '&#3647;' .   $post['currency'];
		break;

	case 'TWD':
		  $post['currency'] = 'NT$' .   $post['currency'];
		break;

	case 'TRY':
		  $post['currency'] = '&#8356;' .   $post['currency'];
		break;
}						
						  
					$donate_postbit = vB_Template::create('dbtech_vbdonate_total_contribs_user');
					$donate_postbit->register('post', $post); 			
					switch ($this->registry->options['dbtech_vbdonate_postbit_contribs'])
					{
						case 1: $template_hook['postbit_start'] .= $donate_postbit->render(); break;
						case 2: $template_hook['postbit_userinfo_left'] .= $donate_postbit->render(); break;
						case 3: $template_hook['postbit_userinfo_right_after_posts'] .= $donate_postbit->render(); break;
						case 4: $template_hook['postbit_userinfo_right'] .= $donate_postbit->render(); break;
						case 5: $template_hook['postbit_messagearea_start'] .= $donate_postbit->render(); break;
						case 6: $template_hook['postbit_signature_start'] .= $donate_postbit->render(); break;
						case 7: $template_hook['postbit_signature_end'] .= $donate_postbit->render(); break;
						//case 8: $template_hook['postbit_controls'] .= $donate_postbit->render(); break;							
					} 									 			
		}
  	}  	
// ####################### END POSTBIT CONTRIBUTIONS AUTO ###################################		  			    	  
// ####################### START POSTBIT CONTRIBUTIONS MANUAL ###############################
	if ($this->registry->options['dbtech_vbdonate_show_postbit_contribs'])
	{	
		$date = date('Y');
			//require_once(DIR . '/dbtech/vbdonate_pro/actions/widget.php');
			$donate_postbit = vB_Template::create('dbtech_vbdonate_total_contribs_user');
			$donate_postbit->register('output', $output);
			$donate_postbit->register('date', $date);
			$donate_postbit->register('post', $post);
			$show['dbtech_vbdonate_total_contribs_user'] = $donate_postbit->render();
	}
// ####################### END POSTBIT CONTRIBUTIONS MANUAL #################################	
	
/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>