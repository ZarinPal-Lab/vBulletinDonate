<?php

// ######################## SET PHP ENVIRONMENT ###########################
error_reporting(E_ALL & ~E_NOTICE);

// ##################### DEFINE IMPORTANT CONSTANTS ######################
define('THIS_SCRIPT', 'vbdonate');

// ################### PRE-CACHE TEMPLATES AND DATA ######################
// get special phrase groups
$phrasegroups = array('dbtech_vbdonate', 'cphome', 'logging', 'threadmanage', 'maintenance', 'banning', 'cpuser', 'cpoption', 'cppermission', 'global');

// get special data templates from the datastore
$specialtemplates = array(
);

// ######################### REQUIRE BACK-END ############################
require_once('./global.php');

// ############################# LOG ACTION ##############################
log_admin_action();

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

if (!file_exists(DIR . '/dbtech/vbdonate_pro/actions/admin/' . $action . '.php'))
{
	if (!file_exists(DIR . '/dbtech/vbdonate/actions/admin/' . $action . '.php'))
	{
		print_cp_message($vbphrase['dbtech_vbdonate_invalid_action']);
	} else {
		include_once(DIR . '/dbtech/vbdonate/actions/admin/' . $action . '.php');	
	}
} else {
	include_once(DIR . '/dbtech/vbdonate_pro/actions/admin/' . $action . '.php');	
}

?>