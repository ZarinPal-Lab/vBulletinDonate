<?php
/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ******************************************************************** >>
<< * ---------------------------------------------------------------- * >>
<< * Copyright �2011-2012 Ozzy47                                      * >>
<< * All Rights Reserved. 											  * >>
<< * This file may not be redistributed in whole or significant part. * >>
<< * ---------------------------------------------------------------- * >>
<< * You are not allowed to use this on your server unless the files  * >>
<< * you downloaded were done so with permission.					  * >>
<< * ---------------------------------------------------------------- * >>
<< ******************************************************************** >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/

print_cp_header($vbphrase['dbtech_vbdonate_dashboard_cpheader']);
print_table_start();
print_form_header('vbdonate_banner', 'vbdonate_dashboard');
print_table_header($vbphrase['dbtech_vbdonate_dashboard_cpheader'], 5);
		{
			if ( $vbulletin->options['dbtech_vbdonate_small_dash_img'])
			{
				$general_settings1 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_general" ><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_genset_image'].'" border="0" height="100px" width="100px" />' . $vbphrase['dbtech_vbdonate_config'] . '</a></center>';
				$general_settings2 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_ZarinPal_payment_settings" ><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_pp_pmnt_sett_image'].'" border="0" height="100px" width="100px" /><br />' . $vbphrase['dbtech_vbdonate_ZarinPalpayment'] . '</a></center>';
				$general_settings3 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_donator_list"><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_don_list_image'].'" border="0" height="100px" width="100px" /><br />' . $vbphrase['dbtech_vbdonate_donatorlist'] . '</a></center>';
				$general_settings4 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_change_group"><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_usergroup_image'].'" border="0" height="100px" width="100px" />' . $vbphrase['dbtech_vbdonate_changegroup'] . '</a></center>';
				$general_settings5 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_donation_pm"><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_send_pm_image'].'" border="0" height="100px" width="100px" /><br />' . $vbphrase['dbtech_vbdonate_donationpm'] . '</a></center>';
				$general_settings6 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_donation_bar"><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_don_bar_image'].'" border="0" height="100px" width="100px" /><br />' . $vbphrase['dbtech_vbdonate_donationbar'] . '</a></center>';
				$general_settings7 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_rot_banner_settings"><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_rot_ban_image'].'" border="0" height="100px" width="100px" /><br />' . $vbphrase['dbtech_vbdonate_rot_banner'] . '</a></center>';
				$general_settings8 = '<center><a href="vbdonate_banner.php?do=content"><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_sliding_ban_image'].'" border="0" height="100px" width="100px" />' . $vbphrase['dbtech_vbdonate_customcontent'] . '</center></a> ';
				$general_settings9 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_sideblock"><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_sideblock_image'].'" border="0" height="100px" width="100px" />' . $vbphrase['dbtech_vbdonate_sideblock_set'] . '</center></a></center>';
				$general_settings10 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_postbit"><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_postbit_image_set'].'" border="0" height="100px" width="100px" />' . $vbphrase['dbtech_vbdonate_postbit_set'] . '</center></a></center>';
				$general_settings11 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_auto_post"><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_genset_image'].'" border="0" height="100px" width="100px" />' . $vbphrase['dbtech_vbdonate_auto_post_settings'] . '</a></center>';
			} else {
				$general_settings1 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_general" ><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_genset_image'].'" border="0" />' . $vbphrase['dbtech_vbdonate_config'] . '</a></center>';
				$general_settings2 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_ZarinPal_payment_settings" ><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_pp_pmnt_sett_image'].'" border="0" /><br />' . $vbphrase['dbtech_vbdonate_ZarinPalpayment'] . '</a></center>';
				$general_settings3 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_donator_list" ><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_don_list_image'].'" border="0" /><br />' . $vbphrase['dbtech_vbdonate_donatorlist'] . '</a> ';
				$general_settings4 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_change_group" ><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_usergroup_image'].'" border="0" />' . $vbphrase['dbtech_vbdonate_changegroup'] . '</a></center>';
				$general_settings5 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_donation_pm" ><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_send_pm_image'].'" border="0" />' . $vbphrase['dbtech_vbdonate_donationpm'] . '</a></center>';
				$general_settings6 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_donation_bar" ><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_don_bar_image'].'" border="0" /><br />' . $vbphrase['dbtech_vbdonate_donationbar'] . '</a></center>';
				$general_settings7 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_rot_banner_settings" ><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_rot_ban_image'].'" border="0" /><br />' . $vbphrase['dbtech_vbdonate_rot_banner'] . '</a> ';
				$general_settings8 = '<center><a href="vbdonate_banner.php?do=content" ><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_sliding_ban_image'].'" border="0" />' . $vbphrase['dbtech_vbdonate_customcontent'] . '</center></a> ';
				$general_settings9 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_sideblock" ><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_sideblock_image'].'" border="0" />' . $vbphrase['dbtech_vbdonate_sideblock_set'] . '</a></center>';
				$general_settings10 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_postbit" ><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_postbit_image_set'].'" border="0" />' . $vbphrase['dbtech_vbdonate_postbit_set'] . '</a></center>';
				$general_settings11 = '<center><a href="options.php?do=options&amp;dogroup=dbtech_vbdonate_auto_post" ><img src="../dbtech/vbdonate/images/admin/'.$vbulletin->options ['dbtech_vbdonate_genset_image'].'" border="0" />' . $vbphrase['dbtech_vbdonate_auto_post_settings'] . '</a></center>';
				$general_settings12 = '<center><iframe src="http://hamyar.org/download/dl.php?do=vr&plugin=zpd&old_vr=1.4"  frameborder="0"></iframe><a href="http://donate.hamyar.org/">حمایت مالی نویسنده پلاگین</a></center>';
			}
		}							
print_cells_row(array($general_settings1,$general_settings2,$general_settings3,$general_settings4), false);
print_cells_row(array($general_settings5,$general_settings6,$general_settings7,$general_settings8), false);
print_cells_row(array($general_settings9,$general_settings10,$general_settings11, $general_settings12), false);
print_submit_row($vbphrase['dbtech_vbdonate_dash_desc'], false, 5, false);
print_cp_footer();

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>
