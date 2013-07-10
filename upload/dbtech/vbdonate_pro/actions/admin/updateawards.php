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

//REMOVE ALL AWARDS
$db->query_write("UPDATE " . TABLE_PREFIX . "userfield SET dbtech_vbdonations_awards = ''");

//ADD AWARDS TO CONFIRMED CONTRIBUTORS
$db->query_write("
	UPDATE " . TABLE_PREFIX . "userfield 
	SET dbtech_vbdonations_awards = '1' 
	WHERE userid IN(
		SELECT userid FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations WHERE confirmed = '1'
	)
");

define('CP_REDIRECT', '../vbdonate.php?do=contrib_table');
print_stop_message('redirect_dbtech_vbdonate_awards_frontend');

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>