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

	$awc_file = 'awcoding/plugins/awc.php';
	$awc_lite_file = 'awcodinglite/functions/trans.php';
	$thistime = time();
 
print_cp_header($vbphrase['dbtech_vbdonate_import_header']);

// ######################## START AWC PRO IMPORTER #########################
	if (file_exists($awc_file))  
	{
		print_form_header('vbdonate_banner', 'doawcimporter');
		print_table_start();
		print_table_header($vbphrase['dbtech_vbdonate_import_pro_awc']);
		print_submit_row($vbphrase['dbtech_vbdonate_awc_button'], false, count($headings));
	} 
	else 
	{
		print_table_header($vbphrase['dbtech_vbdonate_no_pro_awc']);
	}
// ######################## END AWC PRO IMPORTER ###########################

// ######################## START AWC LITE IMPORTER ########################
	if (file_exists($awc_lite_file))
	{
		print_form_header('vbdonate_banner', 'doawcimporter');
		print_table_start();
		print_table_header($vbphrase['dbtech_vbdonate_import_lite_awc']);
		print_submit_row($vbphrase['dbtech_vbdonate_awc_button'], false, count($headings));
	} 
	else 
	{
		print_table_header($vbphrase['dbtech_vbdonate_no_lite_awc']);
	}
// ######################## END AWC LITE IMPORTER ##########################

// ######################## START VSA IMPORTER #############################
	if ($vbulletin->options['vsapaypal_enable']=='1' OR ($vbulletin->options['vsapaypal_enable']=='0'))
	{
		print_form_header('vbdonate_banner', 'dovsaimporter');
		print_table_start();
		print_table_header($vbphrase['dbtech_vbdonate_import_vsa']);
		print_submit_row($vbphrase['dbtech_vbdonate_vsa_button'], false, count($headings));
	} 
	else 
	{
		print_table_header($vbphrase['dbtech_vbdonate_no_vsa']);
	}
// ######################## END VSA IMPORTER ###############################

print_cp_footer();

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/		
?>