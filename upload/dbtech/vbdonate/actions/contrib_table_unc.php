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

	if (($_REQUEST['do'] == 'contrib_table_unc') AND !$vbulletin->options['dbtech_vbdonate_enable'])
	{
		eval(standard_error($vbulletin->options['dbtech_vbdonate_closedreason']));
	}
	if (($_REQUEST['do'] == 'contrib_table_unc') AND $vbulletin->options['dbtech_vbdonate_disable'])
	{
		eval(standard_error($vbulletin->options['dbtech_vbdonate_closedreason']));			
	}                                                            

	$vbulletin->db->hide_errors();
	$vbulletin->input->clean_array_gpc('r', array
		(
			'cs' => TYPE_UINT,
			'co' => TYPE_UINT,
			'so' => TYPE_UINT
		)
	);			

	switch ($vbulletin->GPC['cs'])
	{
		case 1: $dbt_vbd_sort = 'username'; break;
		case 2: $dbt_vbd_sort = 'usergroupid'; break;
		case 3:	$dbt_vbd_sort = 'amount'; break;
		case 4: $dbt_vbd_sort = 'confirmed'; break;
		case 5:	$dbt_vbd_sort = 'dateline'; break;
		case 6:	$dbt_vbd_sort = 'userip'; break;
		default: $dbt_vbd_sort = 'dateline'; break;
	}
            
	switch ($vbulletin->options['dbtech_vbdonate_sort_ord'])
	{
		case 1: $default .= ASC; break;
		case 2: $default  .= DESC; break;
	}            
            
	switch ($vbulletin->GPC['co'])
	{
		case 1: $dbt_vbd_order = 'ASC'; break;
		case 2:	$dbt_vbd_order = 'DESC'; break;
		default: $dbt_vbd_order = $default; break;
	}

	$perpage = $vbulletin->options['dbtech_vbdonate_list_perpage'];
	$pagenumber = $vbulletin->input->clean_gpc('r', 'pagenumber', TYPE_UINT);
	$dbt_vbd_ppl_nrinfo = $vbulletin->db->query_read(" 
		SELECT 
			id, 
			amount,
			netamount, 
			confirmed 
		FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations AS dbtech_vbdonate_donations 
		WHERE dbtech_vbdonate_donations.confirmed = 0
	");
	$dbt_vbd_ppl_nr_con = 0;
	$dbt_vbd_ppl_nr_unc = 0;
	$dbt_vbd_ppl_nr = 0;
	
	while ($dbt_vbd_donamos = $vbulletin->db->fetch_array($dbt_vbd_ppl_nrinfo))
	{
	if ($vbulletin->options['dbtech_vbdonate_net_amount'])
	{
		if ($dbt_vbd_donamos[confirmed]=='0')
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
		if ($dbt_vbd_donamos[confirmed]=='0')
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
			dbtech_vbdonate_donations.id, 
			dbtech_vbdonate_donations.userid, 
			dbtech_vbdonate_donations.userip, 
			dbtech_vbdonate_donations.testdon, 
			dbtech_vbdonate_donations.amount,
			dbtech_vbdonate_donations.netamount, 
			dbtech_vbdonate_donations.dateline, 
			dbtech_vbdonate_donations.confirmed,
		 	dbtech_vbdonate_donations.disclose,
		 	dbtech_vbdonate_donations.anonymous,			
			user.username,			 
			user.usergroupid, 
			user.displaygroupid
		FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations AS dbtech_vbdonate_donations
		LEFT JOIN " . TABLE_PREFIX . "user AS user ON (dbtech_vbdonate_donations.userid = user.userid)
		" . (!is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_canseelist'])) ? 'WHERE dbtech_vbdonate_donations.confirmed = 1' : '') . "
		WHERE dbtech_vbdonate_donations.confirmed = 0
		ORDER BY $dbt_vbd_sort $dbt_vbd_order
		LIMIT " . ($limitlower - 1) . ", $perpage
	");

	$vbulletin->db->show_errors();
	$dbt_vbd_donnum = $limitlower - 1;
	$dbt_vbdd_gotabindex = $dbt_vbd_ppl_nr + 1;
	while ($dbt_vbd_contrib_table_unc = $vbulletin->db->fetch_array($dbt_vbd_ppl_info))
	{
		if (!$vbulletin->options['dbtech_vbdonate_sort_byid'] AND is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_canseelist'])))
		{
			$dbt_vbd_donnum += 1;
		}
		else
		{
			if ($dbt_vbd_contrib_table_unc[confirmed]=='1')
			{
				$dbt_vbd_donnum += 1;
			}
				if ($vbulletin->options['dbtech_vbdonate_sort_byid'] AND is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_canseelist'])))
				{
					$dbt_vbd_donnum = $dbt_vbd_contrib_table_unc[id];
				}
				else
				{
					if ($dbt_vbd_contrib_table_unc[confirmed]=='1')
					{
						$dbt_vbd_donnum = $dbt_vbd_contrib_table_unc[id];
					}				
				}
			}
					
			if ($dbt_vbd_contrib_table_unc['testdon'] == 0)
			{
				$dbt_vbd_contrib_table_unc['testdon'] = '<img src="' . $vbulletin->options['bburl'] . '/dbtech/vbdonate/images/no.jpg" border="0" />';

			} 
			else 
			{
				$dbt_vbd_contrib_table_unc['testdon'] = '<img src="' . $vbulletin->options['bburl'] . '/dbtech/vbdonate/images/yes.jpg" border="0" />';
			}				
					
			$dbt_vbd_donid = $dbt_vbd_contrib_table_unc[id];
			$dbt_vbd_userid = $dbt_vbd_contrib_table_unc[userid];
			$dbt_vbd_userip = $dbt_vbd_contrib_table_unc[userip];
			$dbt_vbd_testdon = $dbt_vbd_contrib_table_unc[testdon];
			$dbt_vbd_contrib_table_unc[username] = fetch_musername($dbt_vbd_contrib_table_unc);
			$dbt_vbd_contrib_table_unc['date'] = vbdate($vbulletin->options['dateformat'], $dbt_vbd_contrib_table_unc['dateline']);

			$templater = vB_Template::Create('dbtech_vbdonate_contrib_table_unc_bit');
			$templater->register('dbt_vbd_contrib_table_unc', $dbt_vbd_contrib_table_unc);
			$templater->register('dbt_vbd_donnum', $dbt_vbd_donnum);
			$templater->register('dbt_vbd_donid', $dbt_vbd_donid);
			$templater->register('dbt_vbd_userip', $dbt_vbd_userip);
			$templater->register('dbt_vbd_testdon', $dbt_vbd_testdon);
			$dbtech_vbdonatecontrib_table_unc .= $templater->render();
	}

	$pagenav = construct_page_nav($pagenumber, $perpage, $dbt_vbd_ppl_nr, 'vbdonate.php?' . $vbulletin->session->vars['sessionurl'] . 'do=contrib_table_unc&amp;cs='.$vbulletin->GPC['cs'].'&amp;co='.$vbulletin->GPC['co'], "");

	$navbits = construct_navbits(array('' => $vbphrase['dbtech_vbdonate_donations']));
	$navbar = render_navbar_template($navbits);

	$templater = vB_Template::Create('dbtech_vbdonate_contrib_table_unc');
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
	$templater->register('dbtech_vbdonate_contrib_table', $dbtech_vbdonatecontrib_table_unc);
	$templater->register('dbt_vbdd_gotabindex', $dbt_vbdd_gotabindex);
	print_output($templater->render());

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>