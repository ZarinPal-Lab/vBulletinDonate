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

$vbulletin -> input -> clean_array_gpc('p', array('disclose' => TYPE_UINT, 'anonymous' => TYPE_UINT, ));

$vbulletin -> input -> clean_gpc('p', 'amount', TYPE_UNUM);

if (strstr($vbulletin -> GPC['amount'], '|')) {
	$dbt_vbd_donate_params = explode('|', $vbulletin -> GPC['amount']);
	$dbt_vbd_donate_amount = $dbt_vbd_donate_params[0];
	$dbt_vbd_donate_subs = $dbt_vbd_donate_params[1];
} else {
	$dbt_vbd_donate_amount = $vbulletin -> GPC['amount'];
	$dbt_vbd_donate_subs = 0;
}

switch ($vbulletin->options['dbtech_vbdonate_dateformat']) {
	case 1 :
		$dbt_vbd_addauto_dtformat = 'd-m-y, H:i';
		break;
	case 2 :
		$dbt_vbd_addauto_dtformat = 'm-d-y, H:i';
		break;
	default :
		$dbt_vbd_addauto_dtformat = 'd-m-y, H:i';
		break;
}

$fee = $vbulletin -> GPC['amount'] - (($vbulletin -> GPC['amount'] * 0.971) - 0.30);
$netamount = (($vbulletin -> GPC['amount'] * 0.971) - 0.30);

if (!$vbulletin -> options['dbtech_vbdonate_allow_disclosed']) {
	$db -> query_write("
			INSERT INTO `" . TABLE_PREFIX . "dbtech_vbdonate_donations`
				(
					userid, 
					amount,
					fee,
					tax,
					netamount, 
					dateline, 
					confirmed, 
					userip, 
					testdon,
					disclose,
					anonymous
				)
				VALUES 
				(
					" . $vbulletin -> userinfo['userid'] . ",
					'" . $db -> escape_string($dbt_vbd_donate_amount) . "',
					'" . $fee . "',
					'0.00',
					'" . $netamount . "',
					" . TIMENOW . ",
					'0',
					'" . IPADDRESS . "',
					'" . ($vbulletin -> options['dbtech_vbdonate_sandbox_enable'] ? '1' : '0') . "',
					'1',
					" . $vbulletin -> GPC['anonymous'] . "
				)
			");
} else {
	$db -> query_write("
			INSERT INTO `" . TABLE_PREFIX . "dbtech_vbdonate_donations`
				(
					userid, 
					amount,
					fee,
					tax, 
					netamount,
					dateline, 
					confirmed, 
					userip, 
					testdon,
					disclose,
					anonymous
				)
				VALUES 
				(
					" . $vbulletin -> userinfo['userid'] . ",
					'" . $db -> escape_string($dbt_vbd_donate_amount) . "',
					'" . $fee . "',
					'0.00',
					'" . $netamount . "',
					" . TIMENOW . ",
					'0',
					'" . IPADDRESS . "',
					'" . ($vbulletin -> options['dbtech_vbdonate_sandbox_enable'] ? '1' : '0') . "',
					" . $vbulletin -> GPC['disclose'] . ",	
					" . $vbulletin -> GPC['anonymous'] . "
				)
			");
}

$donation_data['donations_id'] = $db -> insert_id();

if ($vbulletin -> options['dbtech_vbdonate_unconf_contrib_pm_user'] AND $vbulletin -> userinfo['userid'] AND $vbulletin -> options['dbtech_vbdonate_pm_enable']) {
	require_once (DIR . '/dbtech/vbdonate/includes/unconf_contrib_pm_user.php');
}
if ($vbulletin -> options['dbtech_vbdonate_staff_pm_enable'] AND $vbulletin -> options['dbtech_vbdonate_pm_enable']) {
	require_once (DIR . '/dbtech/vbdonate/includes/staff_pm.php');
}
/*
 * Mohammad Hossein Abedinpour
 */
set_time_limit(-1);
include_once (DIR.'/dbtech/vbdonate/actions/nusoap.php');
$merchantID = $vbulletin->options['dbtech_vbdonate_email'];
$amount =$vbulletin->GPC['amount'];
$callBackUrl = $vbulletin->options['bburl'].'/vbdonate_gateway.php?number='.$donation_data['donations_id'];
$client = new nusoap_client('http://www.zarinpal.com/WebserviceGateway/wsdl', 'wsdl');
$res = $client -> call('PaymentRequest', array($merchantID, $amount, $callBackUrl, urlencode('حمایت از سایت')));
$url='https://www.zarinpal.com/users/pay_invoice/'.$res;
exec_header_redirect($url);
?>