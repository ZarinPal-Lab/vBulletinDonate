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
 
print_cp_header($vbphrase['dbtech_vbdonate_awards_header']);
		print_form_header('vbdonate_banner', 'doawards');
		print_table_start();
		print_table_header($vbphrase['dbtech_vbdonate_update_user_awards']);
		print_submit_row($vbphrase['dbtech_vbdonate_awards_button'], false, count($headings));
		
		print_form_header('vbdonate_banner', 'undoawards');
		print_table_start();
		print_table_header($vbphrase['dbtech_vbdonate_undo_user_awards']);
		print_submit_row($vbphrase['dbtech_vbdonate_undo_awards_button'], false, count($headings));		
print_cp_footer();			

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>