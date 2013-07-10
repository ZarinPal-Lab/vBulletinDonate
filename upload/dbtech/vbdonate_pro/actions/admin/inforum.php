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
			'in_forum'		=> TYPE_NOHTML,
			'contentid' 	=> TYPE_UINT
		)
	);

	$forum	= $vbulletin->GPC['in_forum'];
	$id		= $vbulletin->GPC['contentid'];

// activate/deactivate criteria
	if ($forum == 'in_forum')
	{
		$adding = $vbulletin->db->query_write("
			UPDATE " . TABLE_PREFIX . "dbtech_vbdonate_slider 
			SET
				in_forum = 1
			WHERE contentid = " . intval($id)
		);
	} 
	else 
	{
		$adding = $vbulletin->db->query_write("
			UPDATE " . TABLE_PREFIX . "dbtech_vbdonate_slider 
			SET
				in_forum = 0
			WHERE contentid = " . intval($id)
		);
	}
$vbulletin->url = 'vbdonate_banner.php?' . $vbulletin->session->vars['sessionurl'] . 'do=content';
//define('CP_REDIRECT', 'vbdonate_banner.php?do=content');
eval(print_standard_redirect('redirect_dbtech_vbdonate_inforum_changed'));

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>