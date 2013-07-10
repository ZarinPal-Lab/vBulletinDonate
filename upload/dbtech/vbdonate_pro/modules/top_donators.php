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

		$limit_users = $mod_options['portal_top_contribs_amount'];
		$donations = $db->query("SELECT 
					SUM(donations.amount) AS total_amount,
					SUM(donations.netamount) AS net_total_amount,
					donations.*,
					user.*
				FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations AS donations
				LEFT JOIN " . TABLE_PREFIX . "user AS user ON(user.userid = donations.userid)
				WHERE donations.confirmed = 1 AND donations.disclose = 1 AND donations.anonymous = 0
				GROUP BY donations.userid 
				ORDER BY total_amount DESC LIMIT $limit_users");

	while($top_contribs = $db->fetch_array($donations))
	{				
		$top_contribs[musername] = fetch_musername($top_contribs);
	
		$top_contribs[d_h] = vbdate('H', $top_contribs[dateline]);
		$top_contribs[d_i] = vbdate('i', $top_contribs[dateline]);
		$top_contribs[d_s] = vbdate('s', $top_contribs[dateline]);
		$top_contribs[d_d] = vbdate('d', $top_contribs[dateline]);
		$top_contribs[d_m] = vbdate('m', $top_contribs[dateline]);
		$top_contribs[d_y] = vbdate('Y', $top_contribs[dateline]);

		$templater = vB_Template::create('dbtech_vbdonate_adv_portal_top_bit');
		$templater->register('total_amount', $total_amount);
		$templater->register('net_total_amount', $net_total_amount);
		$templater->register('bgclass',$bgclass);
		$templater->register('mod_options',$mod_options);
		$templater->register('top_contribs',$top_contribs);
		$dbtech_vbdonate_adv_portal_top_bit .= trim($templater->render()).' ';
	}
	$db->free_result($top_contribs);
		$templater = vB_Template::create('dbtech_vbdonate_adv_portal_top');
		$templater->register('total_amount', $total_amount);
		$templater->register('net_total_amount', $net_total_amount);
		$templater->register('mod_options',$mod_options);
		$templater->register('top_contribs',$top_contribs);
		$templater->register('dbtech_vbdonate_adv_portal_top_bit',$dbtech_vbdonate_adv_portal_top_bit);
		$home["$mods[modid]"]['content'] = $templater->render();

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/	
?>