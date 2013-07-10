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

	$vbulletin->db->hide_errors();
	$dbt_vbd_donid = $vbulletin->input->clean_gpc('r', 'donid', TYPE_UINT);
	$dbt_vbd_info = $vbulletin->db->query_first("
		SELECT 
			dbtech_vbdonate_donations.id, 
			dbtech_vbdonate_donations.userid, 
			dbtech_vbdonate_donations.amount, 
			dbtech_vbdonate_donations.dateline, 
			dbtech_vbdonate_donations.confirmed, 
			dbtech_vbdonate_donations.userip,
			dbtech_vbdonate_donations.testdon,
			dbtech_vbdonate_donations.anonymous,
			dbtech_vbdonate_donations.disclose, 
			user.username, user.usergroupid, 
			user.displaygroupid, 
			user.membergroupids
		FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations AS dbtech_vbdonate_donations
		LEFT JOIN " . TABLE_PREFIX . "user AS user ON (dbtech_vbdonate_donations.userid = user.userid)
		WHERE dbtech_vbdonate_donations.id = '".$dbt_vbd_donid."'
		");
		
	$vbulletin->db->show_errors();
	$dbt_vbd_info[username_clean] = $dbt_vbd_info[username];
	$dbt_vbd_info[username] = fetch_musername($dbt_vbd_info);
	$dbt_vbd_info[d_h] = vbdate('H', $dbt_vbd_info[dateline]);
	$dbt_vbd_info[d_i] = vbdate('i', $dbt_vbd_info[dateline]);
	$dbt_vbd_info[d_s] = vbdate('s', $dbt_vbd_info[dateline]);
	$dbt_vbd_info[d_d] = vbdate('d', $dbt_vbd_info[dateline]);
	$dbt_vbd_info[d_m] = vbdate('m', $dbt_vbd_info[dateline]);
	$dbt_vbd_info[d_y] = vbdate('y', $dbt_vbd_info[dateline]);

	$navbits = construct_navbits(array('' => $vbphrase['dbtech_vbdonate_donedit']));
	$navbar = render_navbar_template($navbits);

	$templater = vB_Template::Create('dbtech_vbdonate_contrib_table_edit');
	$templater->register_page_templates();
	$templater->register('navbar', $navbar);
	$templater->register('dbt_vbd_info', $dbt_vbd_info);
	print_output($templater->render());

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>