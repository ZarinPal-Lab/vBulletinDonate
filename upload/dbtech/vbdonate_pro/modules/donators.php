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

		$limit_users = $mod_options['portal_recent_contribs_amount'];
		$donations = $vbulletin->db->query_read("SELECT
					donations.amount AS total_amount,
					donations.netamount AS net_total_amount,
					donations.*,
					user.*
				FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations AS donations
				LEFT JOIN " . TABLE_PREFIX . "user AS user ON(user.userid = donations.userid)
				WHERE donations.confirmed = 1
		ORDER BY donations.dateline DESC LIMIT $limit_users");

	while($recent_contrib = $vbulletin->db->fetch_array($donations))
	{
		$recent_contrib[musername] = fetch_musername($recent_contrib);
		
		$recent_contrib[d_h] = vbdate('H', $recent_contrib[dateline]);
		$recent_contrib[d_i] = vbdate('i', $recent_contrib[dateline]);
		$recent_contrib[d_s] = vbdate('s', $recent_contrib[dateline]);
		$recent_contrib[d_d] = vbdate('d', $recent_contrib[dateline]);
		$recent_contrib[d_m] = vbdate('m', $recent_contrib[dateline]);
		$recent_contrib[d_y] = vbdate('Y', $recent_contrib[dateline]);	

		$templater = vB_Template::create('dbtech_vbdonate_adv_portal_recent_bit');
		$templater->register('total_amount', $total_amount);
		$templater->register('net_total_amount', $net_total_amount);
		$templater->register('bgclass',$bgclass);
		$templater->register('mod_options',$mod_options);
		$templater->register('recent_contrib',$recent_contrib);
		$dbtech_vbdonate_adv_portal_recent_bit .= trim($templater->render()).' ';
	}
	$db->free_result($donations);
		$templater = vB_Template::create('dbtech_vbdonate_adv_portal_recent');
		$templater->register('total_amount', $total_amount);
		$templater->register('net_total_amount', $net_total_amount);
		$templater->register('mod_options',$mod_options);
		$templater->register('recent_contribs',$donations);
		$templater->register('dbtech_vbdonate_adv_portal_recent_bit',$dbtech_vbdonate_adv_portal_recent_bit);
		$home["$mods[modid]"]['content'] = $templater->render();

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/	
?>