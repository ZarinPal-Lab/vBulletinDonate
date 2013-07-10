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

	$thistime = time(); 
	$vbulletin->input->clean_array_gpc('r', array
		(
    		'contentid'	=> TYPE_UINT
		)
	);

	$id	= $vbulletin->GPC['contentid'];

print_cp_header($vbphrase['dbtech_vbdonate_cuscon_cpheader']);
print_form_header('vbdonate_banner', 'doeditcontent');
print_table_start();
 
	$query = $vbulletin->db->query_read("
		SELECT 
			content.*
		FROM " . TABLE_PREFIX . "dbtech_vbdonate_slider content 
		WHERE contentid = " . intval($id)
	);

	while($content_data = $vbulletin->db->fetch_array($query))
	{ 
 		construct_hidden_code('contentid', intval($id));
		print_table_header($vbphrase['dbtech_vbdonate_cuscon_edit_content']);
		print_input_row($vbphrase['dbtech_vbdonate_cuscon_titles'] . '<dfn>' . $vbphrase['dbtech_vbdonate_cuscon_titles_desc'] . '</dfn>', 'title', $content_data['title'], 0, 60);
		print_input_row($vbphrase['dbtech_vbdonate_cuscon_image_loc'] . '<dfn>' . $vbphrase['dbtech_vbdonate_cuscon_image_loc_desc'] . '</dfn>', 'previewimage', $content_data['previewimage'], 0, 60);
		print_yes_no_row($vbphrase['dbtech_vbdonate_cuscon_incms'], 'in_cms', $content_data['in_cms']);
		print_yes_no_row($vbphrase['dbtech_vbdonate_cuscon_inforum'], 'in_forum', $content_data['in_forum']);
   		print_yes_no_row($vbphrase['dbtech_vbdonate_cuscon_actives'], 'active', $content_data['active']);
	}
print_submit_row();
print_cp_footer();

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
 ?>