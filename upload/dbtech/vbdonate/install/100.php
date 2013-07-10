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

self::$db->hide_errors();
	self::$db->query_write("
		CREATE TABLE IF NOT EXISTS " . TABLE_PREFIX . "dbtech_vbdonate_donations 
		(
			id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		    userid INT(10) NOT NULL,
			amount INT(10) NOT NULL,
			dateline INT(20) NOT NULL,
			confirmed INT(1) NOT NULL,
			userip VARCHAR(20) NOT NULL,
			testdon TINYINT (2) UNSIGNED NOT NULL DEFAULT '0'
		)
	");
	self::report('Added Phrases', 'cphome, dbtech_vbdonate, error, vbsettings');
	self::report('Created Table', 'dbtech_vbdonate');

self::$db->hide_errors();    	
	self::$db->query_write("
		CREATE TABLE IF NOT EXISTS " . TABLE_PREFIX . "dbtech_vbdonate_slider 
		(
			contentid INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
			title MEDIUMTEXT NULL,
			previewimage MEDIUMTEXT NULL,
			publishdate VARCHAR(50) BINARY NOT NULL DEFAULT '0',
			active TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
			in_cms TINYINT (2) UNSIGNED NOT NULL DEFAULT '0',
			in_forum TINYINT (2) UNSIGNED NOT NULL DEFAULT '0',
			PRIMARY KEY (contentid)
		)
	");
	self::report('Created Table', 'dbtech_vbdonate_slider');    	

/*if (self::$db_alter->fetch_table_info('dbtech_vbdonate_donations'))
{
	self::$db->hide_errors();	
	self::$db->query_write("
		ALTER TABLE " . TABLE_PREFIX . "dbtech_vbdonate_donations ADD testdon TINYINT (2) UNSIGNED NOT NULL DEFAULT '0' AFTER userip");
	self::$db->hide_errors();	
	self::report('Added Row To Table dbtech_vbdonate_donations', 'testdon');
}*/

self::$db->hide_errors();
	self::$db->query_write("
		INSERT INTO " . TABLE_PREFIX . "dbtech_vbdonate_slider 
			(
				contentid, 
				title, 
				previewimage, 
				publishdate, 
				active, 
				in_cms, 
				in_forum
			) 
		VALUES
			(1, 'Banner 1', 'banner_1.png', '1333679401', 1, 1, 1),
			(2, 'Banner 2', 'banner_2.png', '1333680402', 1, 1, 1),
			(3, 'Banner 3', 'banner_3.png', '1333679403', 1, 1, 1),
			(4, 'Banner 4', 'banner_4.png', '1333679404', 1, 1, 1),
			(5, 'Banner 5', 'banner_5.png', '1333679405', 1, 1, 1),
			(6, 'Banner 6', 'banner_6.png', '1333679406', 1, 1, 1),
			(7, 'Banner 7', 'banner_7.png', '1333679407', 1, 1, 1),
			(8, 'Banner 8', 'banner_8.png', '1333679408', 1, 1, 1),
			(9, 'Banner 9', 'banner_9.png', '1333679409', 1, 1, 1),
			(10, 'Banner 10', 'banner_10.png', '1333679410', 1, 1, 1),
			(11, 'Banner 11', 'banner_11.png', '1333679411', 1, 1, 1),
			(12, 'Banner 12', 'banner_12.png', '1333679412', 1, 1, 1),
			(13, 'Banner 13', 'banner_13.png', '1333679413', 1, 1, 1),
			(14, 'Banner 14', 'banner_14.png', '1333679414', 1, 1, 1),
			(15, 'Banner 15', 'banner_15.png', '1333679415', 1, 1, 1),
			(16, 'Banner 16', 'banner_16.png', '1333679416', 1, 1, 1),
			(17, 'Banner 17', 'banner_17.png', '1333679417', 1, 1, 1),
			(18, 'Banner 18', 'banner_18.png', '1333679418', 1, 1, 1),
			(19, 'Banner 19', 'banner_19.png', '1333679419', 1, 1, 1),
			(20, 'Banner 20', 'banner_20.png', '1333679420', 1, 1, 1),
			(21, 'Banner 21', 'banner_21.png', '1333679421', 1, 1, 1),
			(22, 'Banner 22', 'banner_22.png', '1333679422', 1, 1, 1),
			(23, 'Banner 23', 'banner_23.png', '1333679423', 1, 1, 1),
			(24, 'Banner 24', 'banner_24.png', '1333679424', 1, 1, 1),
			(25, 'Banner 25', 'banner_25.png', '1333679425', 1, 1, 1),
			(26, 'Banner 26', 'banner_26.png', '1333679426', 1, 1, 1),
			(27, 'Banner 27', 'banner_27.png', '1333679427', 1, 1, 1),
			(28, 'Banner 28', 'banner_28.png', '1333679428', 1, 1, 1),
			(29, 'Banner 29', 'banner_29.png', '1333679429', 1, 1, 1),
			(30, 'Banner 30', 'banner_30.png', '1333679430', 1, 1, 1)
	");
	self::report('Added Default Banners', '#1 Through #30');
 	
 //rename('includes/xml/cpnav_dbtech_vbdonate.xml', 'includes/xml/cpnav_dbtech_vbdonates.xml');
 

/*$verified10 = "dbtech/vbdonate/images/verified10.gif";
if (file_exists($verified10))  {
unlink($verified10);
}*/

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>