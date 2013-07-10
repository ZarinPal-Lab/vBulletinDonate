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

	$vbulletin->input->clean_array_gpc('r', array
		(
			'active'		=> TYPE_NOHTML, 
    		'contentid'		=> TYPE_UINT,
			'title'			=> TYPE_NOHTML,
			'in_cms'		=> TYPE_NOHTML,
			'in_cms'		=> TYPE_NOHTML
		)
	);

	$active			=	$vbulletin->GPC['active'];
	$contentid		=	$vbulletin->GPC['contentid'];
	$title			=	$vbulletin->GPC['title'];
	$cms			=	$vbulletin->GPC['in_cms'];
	$forum			=	$vbulletin->GPC['in_forum'];

	print_cp_header($vbphrase['dbtech_vbdonate_cuscon_cpheader']);
	print_table_start();
	print_form_header('vbdonate_banner', 'createcontent');
	print_table_header('<a href="vbdonate_banner.php?do=vbdonate_dashboard"><img src="../dbtech/vbdonate/images/admin/vbd_dash1.png"></a><br />', 4);
	print_table_header($vbphrase['dbtech_vbdonate_cuscon_cpheader'], 4);
	print_cells_row(array
		(
			$vbphrase['dbtech_vbdonate_cuscon_title'], 
			$vbphrase['dbtech_vbdonate_cuscon_cms'], 
			$vbphrase['dbtech_vbdonate_cuscon_forum'], 
			'<center>' . $vbphrase['dbtech_vbdonate_cuscon_controls'] . '
			<br /> 
			[' . $vbphrase['dbtech_vbdonate_cuscon_active'] . ' | 
			' . $vbphrase['dbtech_vbdonate_cuscon_edit'] . ' | 
			' . $vbphrase['dbtech_vbdonate_cuscon_delete'] . ']'
		), true, 4, true) . '<center>';

	$query = $vbulletin->db->query_read("
		SELECT 
			content.contentid, 
			content.title, 
			content.previewimage, 
			content.in_cms, 
			content.in_forum, 
			content.active
		FROM " . TABLE_PREFIX . "dbtech_vbdonate_slider content 
		ORDER BY 
		content.contentid ASC
	");

	while($content_data = $vbulletin->db->fetch_array($query))
	{
		if ($content_data['active'] == 0)
		{
			$active_content = '<a href="vbdonate_banner.php?do=active&amp;contentid=' . $content_data['contentid'] . '&amp;active=active" alt="' . $vbphrase['dbtech_vbdonate_cuscon_set_active'] . '" title="' . $vbphrase['dbtech_vbdonate_cuscon_set_active'] . '"><img src="../dbtech/vbdonate/images/admin/icon_approve_disabled.gif" border="0" /></a> ';
		} 
		else 
		{
			$active_content = '<a href="vbdonate_banner.php?do=active&amp;contentid=' . $content_data['contentid'] . '&amp;active=inactive" alt="' . $vbphrase['dbtech_vbdonate_cuscon_set_inactive'] . '" title="' . $vbphrase['dbtech_vbdonate_cuscon_set_inactive'] . '"><img src="../dbtech/vbdonate/images/admin/icon_approve.gif" border="0" /></a> ';
		}	
			if ($content_data['in_cms'] == 0)
			{
				$active_cms = '<a href="vbdonate_banner.php?do=incms&amp;contentid=' . $content_data['contentid'] . '&amp;in_cms=in_cms" alt="' . $vbphrase['dbtech_vbdonate_cuscon_set_active'] . '" title="' . $vbphrase['dbtech_vbdonate_cuscon_set_active'] . '"><img src="../dbtech/vbdonate/images/admin/no.jpg" border="0" /></a> ';
			} 
			else 
			{
				$active_cms = '<a href="vbdonate_banner.php?do=incms&amp;contentid=' . $content_data['contentid'] . '&amp;in_cms=0" alt="' . $vbphrase['dbtech_vbdonate_cuscon_set_inactive'] . '" title="' . $vbphrase['dbtech_vbdonate_cuscon_set_inactive'] . '"><img src="../dbtech/vbdonate/images/admin/yes.jpg" border="0" /></a> ';
			}		
				if ($content_data['in_forum'] == 0)
				{
					$active_forum = '<a href="vbdonate_banner.php?do=inforum&amp;contentid=' . $content_data['contentid'] . '&amp;in_forum=in_forum" alt="' . $vbphrase['dbtech_vbdonate_cuscon_set_active'] . '" title="' . $vbphrase['dbtech_vbdonate_cuscon_set_active'] . '"><img src="../dbtech/vbdonate/images/admin/no.jpg" border="0" /></a> ';
				} 
				else 
				{
					$active_forum = '<a href="vbdonate_banner.php?do=inforum&amp;contentid=' . $content_data['contentid'] . '&amp;in_forum=0" alt="' . $vbphrase['dbtech_vbdonate_cuscon_set_inactive'] . '" title="' . $vbphrase['dbtech_vbdonate_cuscon_set_inactive'] . '"><img src="../dbtech/vbdonate/images/admin/yes.jpg" border="0" /></a> ';
				}				
				print_cells_row(array
					(
						$content_data['title'] . ' (id: ' . $content_data['contentid'] . ')', 
						$active_cms, $active_forum, '<center>' . 
						$active_content . '<strong>' . ' | ' . '</strong>'  . '&nbsp' . 
						'<a href="vbdonate_banner.php?do=editcontent&amp;contentid=' . $content_data['contentid'] . '" alt="' . $vbphrase['dbtech_vbdonate_cuscon_edit'] . '" title="' . $vbphrase['dbtech_vbdonate_cuscon_edit'] . '"><img src="../dbtech/vbdonate/images/admin/icon_edit.gif" border="0" /></a> ' . '<strong>' . ' | '  . '</strong>' . '&nbsp' .
						'<a href="vbdonate_banner.php?do=delete&amp;contentid=' . $content_data['contentid'] . '" alt="' . $vbphrase['dbtech_vbdonate_cuscon_delete'] . '" title="' . $vbphrase['dbtech_vbdonate_cuscon_delete'] . '"><img src="../dbtech/vbdonate/images/admin/icon_delete.gif" border="0" /></a> '
					), false) . '</center>';	
	}
	
print_submit_row($vbphrase['dbtech_vbdonate_cuscon_submit'], false, 4, false);
print_cp_footer();

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>