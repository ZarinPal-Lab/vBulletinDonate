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

	if (($_REQUEST['do'] == 'donate') AND !$vbulletin->options['dbtech_vbdonate_enable'])
	{
		eval(standard_error($vbulletin->options['dbtech_vbdonate_closedreason']));
	}		
	if (($_REQUEST['do'] == 'donate') AND is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_cantuse'])))
	{
		eval(standard_error($vbulletin->options['dbtech_vbdonate_cantuse_reason']));
	}
	if (($_REQUEST['do'] == 'donate') AND $vbulletin->options['dbtech_vbdonate_disable'])
	{
		eval(standard_error($vbulletin->options['dbtech_vbdonate_closedreason'])); 			
	}

	if ($vbulletin->options['dbtech_vbdonate_enable_bb'])
	{
		require_once(DIR . '/includes/class_bbcode.php');
		$dbt_vbd_parser = new vB_BbCodeParser($vbulletin, fetch_tag_list());
		$vbulletin->options['dbtech_vbdonate_subheader'] = $dbt_vbd_parser->do_parse($vbulletin->options['dbtech_vbdonate_subheader'],1, 1, 1, 1, 1);
	}

	if ($vbulletin->options['dbtech_vbdonate_don_amount']!='')
	{
	require_once(DIR . '/dbtech/vbdonate/includes/functions.php');
	}

	$navbits = construct_navbits(array('' => $vbphrase['dbtech_vbdonate_donate']));
	$navbar = render_navbar_template($navbits);
	$templater = vB_Template::Create('dbtech_vbdonate_donate');
	$templater->register_page_templates();
	$templater->register('navbar', $navbar);
	$templater->register('dbt_vbd_pp_amt_opt', $dbt_vbd_pp_amt_opt);
	$templater->register('dbt_vbd_pp_amt_start', $dbt_vbd_pp_amt_start);	
	print_output($templater->render());

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>