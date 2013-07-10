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

// ####################### SET PHP ENVIRONMENT ###########################
error_reporting(E_ALL & ~E_NOTICE & ~8192);

// #################### DEFINE IMPORTANT CONSTANTS #######################
define('THIS_SCRIPT', 'vbdonate');

// ################### PRE-CACHE TEMPLATES AND DATA ######################

// get templates used by all actions
$globaltemplates = array(
	'dbtech_vbdonate_donate', 
	'dbtech_vbdonate_contrib_table', 
	'dbtech_vbdonate_contrib_table_bit', 
	'dbtech_vbdonate_contrib_table_edit', 
	'dbtech_vbdonate_goal_meter',
	'dbtech_vbdonate_quicklinks_link',
	'dbtech_vbdonate_navbar_link',
	'dbtech_vbdonate_navbar_link_nolist',
	'dbtech_vbdonate_banner',
	'dbtech_vbdonate_slider',
	'dbtech_vbdonate_my_contrib_table',
	'dbtech_vbdonate_my_contrib_table_bit',
	'dbtech_vbdonate_subnav_link',
	'dbtech_vbdonate_subnav_link_nolist',
	'dbtech_vbdonate_sideblock',
	'dbtech_vbdonate_sideblock_bits',
	'dbtech_vbdonate_sideblock_total',
	'dbtech_vbdonate_postbit_donate',
	'dbtech_vbdonate_goal_meter_sideblock'
);

// pre-cache templates used by specific actions
$actiontemplates = array(
	'main' => array(
		'dbtech_vbdonate_main',
        'dbtech_vbdonate_main_links',
        'dbtech_vbdonate_main_links_bits',
	),
    
    'createlink' => array(
		'dbtech_vbdonate_add'
	),
    
);

// get special data templates from the datastore
$specialtemplates = array(
);

// ############################### default do value ######################
if (empty($_REQUEST['do']))
{
	$_REQUEST['do'] = $_GET['do'] = 'main';
}

// ######################### REQUIRE BACK-END ############################

//$forum_directory = 'C:/doc_root/www/domain/forums/';

if ($forum_directory)
{
chdir($forum_directory);
}

require_once('./global.php');
//require_once(DIR . '/dbtech/vbdonate/includes/common_functions.php');


// ########################################################################
// ######################### START MAIN SCRIPT ############################
// ########################################################################

if (empty($_REQUEST['do']))
{
	$_REQUEST['do'] = $_GET['do'] = 'content';
}

if (!empty($_POST['do']))
{
	$action = $_POST['do'];
} elseif(!empty($_GET['do'])) {
	$action = $_GET['do'];
} else {
	$action = 'content';
}

// Strip non-valid characters
$action = preg_replace('/[^\w-]/i', '', $action);  

if (!file_exists(DIR . '/dbtech/vbdonate_pro/actions/' . $action . '.php'))
{
	if (!file_exists(DIR . '/dbtech/vbdonate/actions/' . $action . '.php'))
	{
		eval(standard_error(fetch_error('dbtech_vbdonate_error_x', $vbphrase['dbtech_vbdonate_invalid_action'])));
	} else {
		include_once(DIR . '/dbtech/vbdonate/actions/' . $action . '.php');	
	}
} else {
	include_once(DIR . '/dbtech/vbdonate_pro/actions/' . $action . '.php');	
}

if (!class_exists('vB_Template'))
{
    // Ensure we have this
    require_once(DIR . '/dbtech/vbecommerce/includes/class_template.php');
}

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 19:30, Wed Apr 18th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/

?>