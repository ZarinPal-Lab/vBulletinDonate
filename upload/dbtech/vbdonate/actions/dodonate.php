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

$vbulletin->input->clean_array_gpc('p', array('disclose' => TYPE_UINT, 'anonymous' => TYPE_UINT,));

$vbulletin->input->clean_gpc('p', 'amount', TYPE_UNUM);

if (strstr($vbulletin->GPC['amount'], '|')) {
    $dbt_vbd_donate_params = explode('|', $vbulletin->GPC['amount']);
    $dbt_vbd_donate_amount = $dbt_vbd_donate_params[0];
    $dbt_vbd_donate_subs = $dbt_vbd_donate_params[1];
} else {
    $dbt_vbd_donate_amount = $vbulletin->GPC['amount'];
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

$fee = $vbulletin->GPC['amount'] - (($vbulletin->GPC['amount'] * 0.971) - 0.30);
$netamount = (($vbulletin->GPC['amount'] * 0.971) - 0.30);

if (!$vbulletin->options['dbtech_vbdonate_allow_disclosed']) {
    $db->query_write("
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
					" . $vbulletin->userinfo['userid'] . ",
					'" . $db->escape_string($dbt_vbd_donate_amount) . "',
					'" . $fee . "',
					'0.00',
					'" . $netamount . "',
					" . TIMENOW . ",
					'0',
					'" . IPADDRESS . "',
					'" . ($vbulletin->options['dbtech_vbdonate_sandbox_enable'] ? '1' : '0') . "',
					'1',
					" . $vbulletin->GPC['anonymous'] . "
				)
			");
} else {
    $db->query_write("
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
					" . $vbulletin->userinfo['userid'] . ",
					'" . $db->escape_string($dbt_vbd_donate_amount) . "',
					'" . $fee . "',
					'0.00',
					'" . $netamount . "',
					" . TIMENOW . ",
					'0',
					'" . IPADDRESS . "',
					'" . ($vbulletin->options['dbtech_vbdonate_sandbox_enable'] ? '1' : '0') . "',
					" . $vbulletin->GPC['disclose'] . ",	
					" . $vbulletin->GPC['anonymous'] . "
				)
			");
}

$donation_data['donations_id'] = $db->insert_id();

if ($vbulletin->options['dbtech_vbdonate_unconf_contrib_pm_user'] and $vbulletin->userinfo['userid'] and $vbulletin->options['dbtech_vbdonate_pm_enable']) {
    require_once(DIR . '/dbtech/vbdonate/includes/unconf_contrib_pm_user.php');
}
if ($vbulletin->options['dbtech_vbdonate_staff_pm_enable'] and $vbulletin->options['dbtech_vbdonate_pm_enable']) {
    require_once(DIR . '/dbtech/vbdonate/includes/staff_pm.php');
}


$data = array(
    'merchant_id' => $vbulletin->options['dbtech_vbdonate_email'],
   'amount' => $vbulletin->GPC['amount'] * 10,
    'description' => 'حمایت از سایت',
    'callback_url' => $vbulletin->options['bburl'] . '/vbdonate_gateway.php?number=' . $donation_data['donations_id']
);
$jsonData = json_encode($data);

$ch = curl_init('https://api.zarinpal.com/pg/v4/payment/request.json');
curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
));

$result = curl_exec($ch);
$err = curl_error($ch);
$result = json_decode($result, true, JSON_PRETTY_PRINT);
curl_close($ch);

if ($result['data']['code'] == 100) {
    header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
} else {
    echo 'ERR: ' . $result['errors']['code'];
}

?>
