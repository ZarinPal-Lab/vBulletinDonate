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
    		'contentid'		=> TYPE_UINT,
			'title'			=> TYPE_NOHTML,
			'previewimage'	=> TYPE_NOHTML,
			'active'		=> TYPE_UINT,
			'in_cms'		=> TYPE_UINT,
			'in_forum'		=> TYPE_UINT,
	
		)
	);

//Set, check and clean the new Custom Content variables
	$id				=	$vbulletin->GPC['contentid'];
	$title			=	$vbulletin->GPC['title'];
	$previewimage	=	$vbulletin->GPC['previewimage'];
	$active			=	$vbulletin->GPC['active'];
	$in_cms			=	$vbulletin->GPC['in_cms'];
	$in_forum		=	$vbulletin->GPC['in_forum'];

	$adding = $vbulletin->db->query_write("
		UPDATE " . TABLE_PREFIX . "dbtech_vbdonate_slider
		SET
			title = " . $vbulletin->db->sql_prepare($title) . ",
			previewimage = " . $vbulletin->db->sql_prepare($previewimage) . ",
			publishdate = " . $thistime . ",
			active = " . $vbulletin->db->sql_prepare($active) .",
			in_cms = " . $vbulletin->db->sql_prepare($in_cms) .",
			in_forum = " . $vbulletin->db->sql_prepare($in_forum) ."		
		WHERE
			contentid = " . intval($id)
	);

define('CP_REDIRECT', 'vbdonate_banner.php?do=content');
print_stop_message('redirect_dbtech_vbdonate_content_edited');

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>