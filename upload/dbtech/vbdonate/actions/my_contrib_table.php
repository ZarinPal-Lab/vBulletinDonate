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

	if (($_REQUEST['do'] == 'my_contrib_table') AND !$vbulletin->options['dbtech_vbdonate_enable'])
	{
		eval(standard_error($vbulletin->options['dbtech_vbdonate_closedreason']));
	}
	if (($_REQUEST['do'] == 'my_contrib_table') AND is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_cansee_mylist'])))
	{
		eval(standard_error($vbulletin->options['dbtech_vbdonate_canseelist_reason']));
	}
	if (($_REQUEST['do'] == 'my_contrib_table') AND $vbulletin->options['dbtech_vbdonate_disable'])
	{
		eval(standard_error($vbulletin->options['dbtech_vbdonate_closedreason']));			
	}                                                            

	$vbulletin->db->hide_errors();
	$vbulletin->input->clean_array_gpc('r', array
		(
			'cs' => TYPE_UINT,
			'co' => TYPE_UINT
		)
	);

	switch ($vbulletin->GPC['cs'])
	{
		//case 1: $dbt_vbd_sort = 'username'; break;
		//case 2: $dbt_vbd_sort = 'usergroupid'; break;
		case 3:	$dbt_vbd_sort = 'amount'; break;
		//case 4: $dbt_vbd_sort = 'confirmed'; break;
		case 5:	$dbt_vbd_sort = 'dateline'; break;
		//case 6:	$dbt_vbd_sort = 'userip'; break;
		default: $dbt_vbd_sort = 'dateline'; break;
	}

	switch ($vbulletin->GPC['co'])
	{
		case 1: $dbt_vbd_order = 'ASC'; break;
		case 2:	$dbt_vbd_order = 'DESC'; break;
		default: $dbt_vbd_order = 'DESC'; break;
	}

	$perpage = $vbulletin->options['dbtech_vbdonate_list_perpage'];
	$pagenumber = $vbulletin->input->clean_gpc('r', 'pagenumber', TYPE_UINT);
	$dbt_vbd_ppl_nrinfo = $vbulletin->db->query_read(" 
		SELECT 
			vbd.id, 
			vbd.amount,
			vbd.netamount, 
			vbd.confirmed 
			FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations vbd 
			WHERE
				vbd.userid = " . $vbulletin->userinfo['userid'] . "	
		");	
	$dbt_vbd_ppl_nr_con = 0;
	$dbt_vbd_ppl_nr_unc = 0;
	$dbt_vbd_ppl_nr = 0;
	while ($dbt_vbd_donamos = $vbulletin->db->fetch_array($dbt_vbd_ppl_nrinfo))
	{
	if ($vbulletin->options['dbtech_vbdonate_net_amount'])
	{
		if ($dbt_vbd_donamos[confirmed]=='1')
		{
			$dbt_vbd_ppl_nr_con += 1;
			$dbt_vbdd_totamo += $dbt_vbd_donamos[netamount];
		}
		else
		{
		$dbt_vbd_ppl_nr_unc += 1;
		}
	}
	else
	{
		if ($dbt_vbd_donamos[confirmed]=='1')
		{
			$dbt_vbd_ppl_nr_con += 1;
			$dbt_vbdd_totamo += $dbt_vbd_donamos[amount];
		}
		else
		{
		$dbt_vbd_ppl_nr_unc += 1;
		}
	}
	}

	if (is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_canseelist'])))
	{
		$dbt_vbd_ppl_nr = $dbt_vbd_ppl_nr_con + $dbt_vbd_ppl_nr_unc;
	}
	else
	{
		$dbt_vbd_ppl_nr = $dbt_vbd_ppl_nr_con;
	}
			
	sanitize_pageresults($dbt_vbd_ppl_nr, $pagenumber, $perpage, 100, 25);
	$limitlower = ($pagenumber - 1) * $perpage + 1;
	$limitupper = $pagenumber * $perpage;
	if ($limitupper > $dbt_vbd_ppl_nr)
	{
		$limitupper = $dbt_vbd_ppl_nr;
		if ($limitlower > $dbt_vbd_ppl_nr)
		{
			$limitlower = $dbt_vbd_ppl_nr - $perpage;
		}
			}
			if ($limitlower <= 0)
			{
				$limitlower = 1;
	}
			
	$dbt_vbd_ppl_info = $vbulletin->db->query_read("
		SELECT 
			vbd.id, 
			vbd.userid, 
			vbd.userip, 
			vbd.testdon, 
			vbd.amount,
			vbd.netamount, 
			vbd.dateline, 
			vbd.confirmed, 
			u.username, 
			u.usergroupid, 
			u.displaygroupid
		FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations vbd
		LEFT JOIN " . TABLE_PREFIX . "user u ON (vbd.userid = u.userid)
		WHERE 
			vbd.userid = " . $vbulletin->userinfo['userid'] . " 
			" . (!is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_canseelist'])) ? ' && vbd.confirmed = 1' : '') . "
			ORDER BY 
				$dbt_vbd_sort $dbt_vbd_order
			LIMIT
				" . ($limitlower - 1) . ", $perpage
	");
			

	$vbulletin->db->show_errors();
	$dbt_vbd_donnum = $limitlower - 1;
	$dbt_vbdd_gotabindex = $dbt_vbd_ppl_nr + 1;
	while ($dbt_vbd_my_contrib_table = $vbulletin->db->fetch_array($dbt_vbd_ppl_info))
	{
		if (is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_canseelist'])))
		{
			$dbt_vbd_donnum += 1;
		}
		else
		{
		if ($dbt_vbd_my_contrib_table[confirmed]=='1')
		{
			$dbt_vbd_donnum += 1;
		}
	}
									
	if ($dbt_vbd_my_contrib_table['testdon'] == 0)
	{
		$dbt_vbd_my_contrib_table['testdon'] = '<img src="' . $vbulletin->options['bburl'] . '/dbtech/vbdonate/images/no.jpg" border="0" />';
	} 
	else 
	{
		$dbt_vbd_my_contrib_table['testdon'] = '<img src="' . $vbulletin->options['bburl'] . '/dbtech/vbdonate/images/yes.jpg" border="0" />';
	}				
					
	$dbt_vbd_donid = $dbt_vbd_my_contrib_table[id];
	$dbt_vbd_userid = $dbt_vbd_my_contrib_table[userid];
	$dbt_vbd_userip = $dbt_vbd_my_contrib_table[userip];
	$dbt_vbd_testdon = $dbt_vbd_my_contrib_table[testdon];
	$dbt_vbd_my_contrib_table[username] = fetch_musername($dbt_vbd_my_contrib_table);
	$dbt_vbd_my_contrib_table['date'] = vbdate($vbulletin->options['dateformat'], $dbt_vbd_my_contrib_table['dateline']);

	$templater = vB_Template::Create('dbtech_vbdonate_my_contrib_table_bit');
	$templater->register('dbt_vbd_my_contrib_table', $dbt_vbd_my_contrib_table);
	$templater->register('dbt_vbd_donnum', $dbt_vbd_donnum);
	$templater->register('dbt_vbd_donid', $dbt_vbd_donid);
	//$templater->register('dbt_vbd_userip', $dbt_vbd_userip);
	$templater->register('dbt_vbd_testdon', $dbt_vbd_testdon);
	$dbtech_vbdonatemy_contrib_table .= $templater->render();
	}

	$pagenav = construct_page_nav($pagenumber, $perpage, $dbt_vbd_ppl_nr, 'vbdonate.php?' . $vbulletin->session->vars['sessionurl'] . 'do=my_contrib_table&amp;cs='.$vbulletin->GPC['cs'].'&amp;co='.$vbulletin->GPC['co'], "");

	$navbits = construct_navbits(array('' => $vbphrase['dbtech_vbdonate_donations']));
	$navbar = render_navbar_template($navbits);

	$templater = vB_Template::Create('dbtech_vbdonate_my_contrib_table');
	$templater->register_page_templates();
	$templater->register('navbar', $navbar);
	$templater->register('pagenav', $pagenav);
	$templater->register('dbt_vbd_ppl_nr', $dbt_vbd_ppl_nr);
	$templater->register('dbt_vbd_ppl_nr_con', $dbt_vbd_ppl_nr_con);
	$templater->register('dbt_vbd_ppl_nr_unc', $dbt_vbd_ppl_nr_unc);
	$templater->register('dbt_vbd_sort', $dbt_vbd_sort);
	$templater->register('dbt_vbd_order', $dbt_vbd_order);
	$templater->register('dbt_vbdd_totamo', vb_number_format($dbt_vbdd_totamo,2));
	$templater->register('admincpdir', $admincpdir);
	$templater->register('dbtech_vbdonate_my_contrib_table', $dbtech_vbdonatemy_contrib_table);
	$templater->register('dbt_vbdd_gotabindex', $dbt_vbdd_gotabindex);
	print_output($templater->render());

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>