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

// ######################### SET PHP ENVIRONMENT ###########################
error_reporting(E_ALL & ~E_NOTICE);

// #################### DEFINE IMPORTANT CONSTANTS #######################
define('THIS_SCRIPT', 'sendmessage');
define('CSRF_PROTECTION', true);

// ################### PRE-CACHE TEMPLATES AND DATA ######################
// get special phrase groups
$phrasegroups = array('messaging');

// get special data templates from the datastore
$specialtemplates = array();

// pre-cache templates used by all actions
$globaltemplates = array(
	'mailform',
	'sendtofriend',
	'contactus',
	'contactus_option',
	'newpost_errormessage',
);

// pre-cache templates used by specific actions
$actiontemplates = array(
	'im' => array(
		'im_send_aim',
		'im_send_yahoo',
		'im_send_msn',
		'im_send_skype',
		'im_message'
	),
	'sendtofriend' => array(
		'newpost_usernamecode',
		'humanverify'
	),
	'contactus' => array(
		'humanverify',
	),
);

$actiontemplates['none'] =& $actiontemplates['contactus'];
$actiontemplates['docontactus'] =& $actiontemplates['contactus'];

// Strip non-valid characters
$action = preg_replace('/[^\w-]/i', '', $action);

// ######################### REQUIRE BACK-END ############################
require_once('./global.php');

// #######################################################################
// ######################## START MAIN SCRIPT ############################
// #######################################################################

if (($_REQUEST['do'] == 'contactus') AND is_member_of($vbulletin->userinfo, explode(',', $vbulletin->options['dbtech_vbdonate_cantuse'])))
{
	eval(standard_error($vbulletin->options['dbtech_vbdonate_cantuse_reason']));
}

if (empty($_REQUEST['do']))
{
	$_REQUEST['do'] = 'contactus';
}

($hook = vBulletinHook::fetch_hook('sendmessage_start')) ? eval($hook) : false;

// ##################################################################################
// ALL other actions from here onward require email permissions, so check that now...
// *** email permissions ***
/*if (!$vbulletin->options['enableemail'])
{
	eval(standard_error(fetch_error('emaildisabled')));
}*/

$perform_floodcheck = (
	!($permissions['adminpermissions'] & $vbulletin->bf_ugp_adminpermissions['cancontrolpanel'])
	AND $vbulletin->options['emailfloodtime']
	AND $vbulletin->userinfo['userid']
);

if ($perform_floodcheck AND ($timepassed = TIMENOW - $vbulletin->userinfo['emailstamp']) < $vbulletin->options['emailfloodtime'])
{
	eval(standard_error(fetch_error('emailfloodcheck', $vbulletin->options['emailfloodtime'], ($vbulletin->options['emailfloodtime'] - $timepassed))));
}

// initialize errors array
$errors = array();

// ############################### do contact webmaster ###############################
if ($_POST['do'] == 'docontactus')
{
	if (!$vbulletin->userinfo['userid'] AND !$vbulletin->options['contactustype'])
	{
		print_no_permission();
	}

	$vbulletin->input->clean_array_gpc('p', array(
		'name'          => TYPE_STR,
		'email'         => TYPE_STR,
		'subject'       => TYPE_STR,
		'message'       => TYPE_STR,
		'other_subject' => TYPE_STR,
		'humanverify'   => TYPE_ARRAY,
	));

	($hook = vBulletinHook::fetch_hook('sendmessage_docontactus_start')) ? eval($hook) : false;

	// Used in phrase(s)
	$subject =& $vbulletin->GPC['subject'];
	$name =& $vbulletin->GPC['name'];
	$message =& $vbulletin->GPC['message'];
	$email =& $vbulletin->GPC['email'];

	// check we have a message and a subject
	if ($message == '' OR $subject == ''
			OR (
				$vbulletin->options['dbtech_vbdonate_contactusoptions']
				AND $subject == 'other'
				AND ($vbulletin->GPC['other_subject'] == '' OR !$vbulletin->options['contactusother'])
			)
		)
	{
		$errors[] = fetch_error('nosubject');
	}

	// check for valid email address
	if (!is_valid_email($vbulletin->GPC['email']))
	{
		$errors[] = fetch_error('bademail');
	}

	if (fetch_require_hvcheck('contactus'))
	{
		require_once(DIR . '/includes/class_humanverify.php');
		$verify =& vB_HumanVerify::fetch_library($vbulletin);
		if (!$verify->verify_token($vbulletin->GPC['humanverify']))
		{
	  		$errors[] = fetch_error($verify->fetch_error());
	  	}
	}

	($hook = vBulletinHook::fetch_hook('sendmessage_docontactus_process')) ? eval($hook) : false;

	// if it's all good... send the email
	if (empty($errors))
	{
		$languageid = -1;
		if ($vbulletin->options['dbtech_vbdonate_contactusoptions'])
		{
			if ($subject == 'other')
			{
				$subject = $vbulletin->GPC['other_subject'];
			}
			else
			{
				$options = explode("\n", trim($vbulletin->options['dbtech_vbdonate_contactusoptions']));
				foreach($options AS $index => $title)
				{
					if ($index == $subject)
					{
						if (preg_match('#^{(.*)} (.*)$#siU', $title, $matches))
						{
							$title =& $matches[2];
							if (is_numeric($matches[1]) AND intval($matches[1]) !== 0)
							{
								$userinfo = fetch_userinfo($matches[1]);
								$alt_email =& $userinfo['email'];
								$languageid =& $userinfo['languageid'];
							}
							else
							{
								$alt_email = $matches[1];
							}
						}
						$subject = $title;
						break;
					}
				}
			}
		}

		if (!empty($alt_email))
		{
			if ($alt_email == $vbulletin->options['webmasteremail'] OR $alt_email == $vbulletin->options['contactusemail'])
			{
				$ip = IPADDRESS;
			}
			else
			{
				$ip =& $vbphrase['n_a'];
			}
			$destemail =& $alt_email;
		}
		else
		{
			$ip = IPADDRESS;
			if ($vbulletin->options['contactusemail'])
			{
				$destemail =& $vbulletin->options['contactusemail'];
			}
			else
			{
				$destemail =& $vbulletin->options['webmasteremail'];
			}
		}

		($hook = vBulletinHook::fetch_hook('sendmessage_docontactus_complete')) ? eval($hook) : false;

		$url =& $vBulletin->url;
		eval(fetch_email_phrases('contactus', $languageid));
		vbmail($destemail, $subject, $message, false, $vbulletin->GPC['email'], '', $name);

		print_standard_redirect('redirect_dbtech_vbdonate_contactus_request_sent', true, true);  
	}
	// there are errors!
	else
	{
		$errormessages = '';
		if (!empty($errors))
		{
			$show['errors'] = true;
			$templater = vB_Template::create('newpost_errormessage');
			$templater->register('errors', $errors);
			$errormessages .= $templater->render();
		}

		$_REQUEST['do'] = 'contactus';
	}

}

// ############################### start contact webmaster ###############################
if ($_REQUEST['do'] == 'contactus')
{
	if (!$vbulletin->userinfo['userid'] AND !$vbulletin->options['contactustype'])
	{
		print_no_permission();
	}

	// These values may have already been cleaned in the previous action so we can not clean them again here (TYPE_NOHTML)
	$vbulletin->input->clean_array_gpc('r', array(
		'name'		=> TYPE_STR,
		'email'		=> TYPE_STR,
		'subject'	=> TYPE_STR,
		'other_subject' => TYPE_STR,
		'message'	=> TYPE_STR,
	));

	($hook = vBulletinHook::fetch_hook('sendmessage_contactus_start')) ? eval($hook) : false;

	$name = htmlspecialchars_uni($vbulletin->GPC['name']);
	$email = htmlspecialchars_uni($vbulletin->GPC['email']);
	$subject = htmlspecialchars_uni($vbulletin->GPC['subject']);
	$other_subject = htmlspecialchars_uni($vbulletin->GPC['other_subject']);
	$message = htmlspecialchars_uni($vbulletin->GPC['message']);

	// enter $vbulletin->userinfo's name and email if necessary
	if ($name == '' AND $vbulletin->userinfo['userid'] > 0)
	{
		$name = $vbulletin->userinfo['username'];
	}
	if ($email == '' AND $vbulletin->userinfo['userid'] > 0)
	{
		$email = $vbulletin->userinfo['email'];
	}

	if ($vbulletin->options['dbtech_vbdonate_contactusoptions'])
	{
		$options = explode("\n", trim($vbulletin->options['dbtech_vbdonate_contactusoptions']));
		foreach($options AS $index => $title)
		{
			// Look for the {(int)} or {(email)} identifier at the start and strip it out
			if (preg_match('#^({.*}) (.*)$#siU', $title, $matches))
			{
				$title =& $matches[2];
			}

			if ($subject == strval($index))
			{
				$checked = 'checked="checked"';
			}

			($hook = vBulletinHook::fetch_hook('sendmessage_contactus_option')) ? eval($hook) : false;

			$templater = vB_Template::create('dbtech_vbdonate_request_conf_option');
				$templater->register('checked', $checked);
				$templater->register('index', $index);
				$templater->register('title', $title);
			$contactusoptions .= $templater->render();
			unset($checked);
		}
	}

	$other_subject_checked = ($subject == 'other' ? 'checked="checked"' : '');

	if (fetch_require_hvcheck('contactus'))
	{
		require_once(DIR . '/includes/class_humanverify.php');
		$verification =& vB_HumanVerify::fetch_library($vbulletin);
		$human_verify = $verification->output_token();
	}
	else
	{
		$human_verify = '';
	}

	// generate navbar
	$navbits = construct_navbits(array('' => $vbphrase['dbtech_vbdonate_contactus']));
	$navbar = render_navbar_template($navbits);

	($hook = vBulletinHook::fetch_hook('sendmessage_contactus_complete')) ? eval($hook) : false;

	$url =& $vbulletin->url;
	$templater = vB_Template::create('dbtech_vbdonate_request_conf');
		$templater->register_page_templates();
		$templater->register('contactusoptions', $contactusoptions);
		$templater->register('email', $email);
		$templater->register('errormessages', $errormessages);
		$templater->register('human_verify', $human_verify);
		$templater->register('message', $message);
		$templater->register('name', $name);
		$templater->register('navbar', $navbar);
		$templater->register('subject', $subject);
		$templater->register('url', $url);
		$templater->register('other_subject', $other_subject);
		$templater->register('other_subject_checked', $other_subject_checked);
	print_output($templater->render());
}

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 19:30, Wed Apr 18th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>