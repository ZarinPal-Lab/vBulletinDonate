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

if ($_REQUEST['action'] == 'csv' OR empty($_REQUEST['action']))
{
	// We need this now
	require_once(DIR . '/includes/functions_misc.php');

	print_cp_header($vbphrase['dbtech_vbdonate_transaction_list']);
	//CONFIRMED CONTRIBUTIONS
	print_form_header('vbdonate_banner', 'csv');
	construct_hidden_code('action', 'download_confirmed');
	print_table_header($vbphrase['dbtech_vbdonate_download_confirmed_list']);
	print_description_row($vbphrase['dbtech_vbdonate_download_confirmed_list_descr']);
	/*
	print_select_row($vbphrase['show_only_entries_generated_by'], 'status', array(
		'' 			=> $vbphrase['dbtech_vbecommerce_all_transactions'],
		'onlyvat' 	=> $vbphrase['dbtech_vbecommerce_vat_eligible_transactions'],
		'novat' 	=> $vbphrase['dbtech_vbecommerce_non_vat_eligible_transactions'],
		'refunded' 	=> $vbphrase['dbtech_vbecommerce_vat_refunded_transactions'],
		'reverted' 	=> $vbphrase['dbtech_vbecommerce_reversed_transactions'],
	), '');
	 */
	print_time_row($vbphrase['start_date'], 'datestart_confirmed', vbmktime(0, 0, 0, 1, 1, 2011));
	print_time_row($vbphrase['end_date'], 'dateend_confirmed', vbmktime(0, 0, 0, 12, 31, 2012));
	print_submit_row($vbphrase['download'], false);

	//UNCONFIRMED CONTRIBUTIONS	
	print_form_header('vbdonate_banner', 'csv');
	construct_hidden_code('action', 'download_unconfirmed');
	print_table_header($vbphrase['dbtech_vbdonate_download_unconfirmed_list']);
	print_description_row($vbphrase['dbtech_vbdonate_download_unconfirmed_list_descr']);
	/*
	print_select_row($vbphrase['show_only_entries_generated_by'], 'status', array(
		'' 			=> $vbphrase['dbtech_vbecommerce_all_transactions'],
		'onlyvat' 	=> $vbphrase['dbtech_vbecommerce_vat_eligible_transactions'],
		'novat' 	=> $vbphrase['dbtech_vbecommerce_non_vat_eligible_transactions'],
		'refunded' 	=> $vbphrase['dbtech_vbecommerce_vat_refunded_transactions'],
		'reverted' 	=> $vbphrase['dbtech_vbecommerce_reversed_transactions'],
	), '');
	 */
	print_time_row($vbphrase['start_date'], 'datestart_unconfirmed', vbmktime(0, 0, 0, 1, 1, 2011));
	print_time_row($vbphrase['end_date'], 'dateend_unconfirmed', vbmktime(0, 0, 0, 12, 31, 2012));
	print_submit_row($vbphrase['download'], false);	
	
	//ANONYMOUS CONTRIBUTIONS	
	print_form_header('vbdonate_banner', 'csv');
	construct_hidden_code('action', 'download_anonymous');
	print_table_header($vbphrase['dbtech_vbdonate_download_anonymous_list']);
	print_description_row($vbphrase['dbtech_vbdonate_download_anonymous_list_descr']);
	/*
	print_select_row($vbphrase['show_only_entries_generated_by'], 'status', array(
		'' 			=> $vbphrase['dbtech_vbecommerce_all_transactions'],
		'onlyvat' 	=> $vbphrase['dbtech_vbecommerce_vat_eligible_transactions'],
		'novat' 	=> $vbphrase['dbtech_vbecommerce_non_vat_eligible_transactions'],
		'refunded' 	=> $vbphrase['dbtech_vbecommerce_vat_refunded_transactions'],
		'reverted' 	=> $vbphrase['dbtech_vbecommerce_reversed_transactions'],
	), '');
	 */
	print_time_row($vbphrase['start_date'], 'datestart_anonymous', vbmktime(0, 0, 0, 1, 1, 2011));
	print_time_row($vbphrase['end_date'], 'dateend_anonymous', vbmktime(0, 0, 0, 12, 31, 2012));
	print_submit_row($vbphrase['download'], false);	
	
	//UNDISCLOSED CONTRIBUTIONS	
	print_form_header('vbdonate_banner', 'csv');
	construct_hidden_code('action', 'download_undisclosed');
	print_table_header($vbphrase['dbtech_vbdonate_download_undisclosed_list']);
	print_description_row($vbphrase['dbtech_vbdonate_download_undisclosed_list_descr']);
	/*
	print_select_row($vbphrase['show_only_entries_generated_by'], 'status', array(
		'' 			=> $vbphrase['dbtech_vbecommerce_all_transactions'],
		'onlyvat' 	=> $vbphrase['dbtech_vbecommerce_vat_eligible_transactions'],
		'novat' 	=> $vbphrase['dbtech_vbecommerce_non_vat_eligible_transactions'],
		'refunded' 	=> $vbphrase['dbtech_vbecommerce_vat_refunded_transactions'],
		'reverted' 	=> $vbphrase['dbtech_vbecommerce_reversed_transactions'],
	), '');
	 */
	print_time_row($vbphrase['start_date'], 'datestart_undisclosed', vbmktime(0, 0, 0, 1, 1, 2011));
	print_time_row($vbphrase['end_date'], 'dateend_undisclosed', vbmktime(0, 0, 0, 12, 31, 2012));
	print_submit_row($vbphrase['download'], false);	
	
	//UNDISCLOSED CONTRIBUTIONS	
	print_form_header('vbdonate_banner', 'csv');
	construct_hidden_code('action', 'download_test');
	print_table_header($vbphrase['dbtech_vbdonate_download_test_list']);
	print_description_row($vbphrase['dbtech_vbdonate_download_test_list_descr']);
	/*
	print_select_row($vbphrase['show_only_entries_generated_by'], 'status', array(
		'' 			=> $vbphrase['dbtech_vbecommerce_all_transactions'],
		'onlyvat' 	=> $vbphrase['dbtech_vbecommerce_vat_eligible_transactions'],
		'novat' 	=> $vbphrase['dbtech_vbecommerce_non_vat_eligible_transactions'],
		'refunded' 	=> $vbphrase['dbtech_vbecommerce_vat_refunded_transactions'],
		'reverted' 	=> $vbphrase['dbtech_vbecommerce_reversed_transactions'],
	), '');
	 */
	print_time_row($vbphrase['start_date'], 'datestart_test', vbmktime(0, 0, 0, 1, 1, 2011));
	print_time_row($vbphrase['end_date'], 'dateend_test', vbmktime(0, 0, 0, 12, 31, 2012));
	print_submit_row($vbphrase['download'], false);			
	
}

// #############################################################################
if (
		$_REQUEST['action'] == 'download_confirmed' 
		OR 
		$_REQUEST['action'] == 'download_unconfirmed' 
		OR 
		$_REQUEST['action'] == 'download_anonymous'
		OR 
		$_REQUEST['action'] == 'download_undisclosed'
		OR 
		$_REQUEST['action'] == 'download_test'		
	)
{
	$vbulletin->input->clean_array_gpc('r', array(
		'status' 					=> TYPE_STR,
		'datestart_confirmed' 		=> TYPE_UNIXTIME,
		'dateend_confirmed' 		=> TYPE_UNIXTIME,
		'datestart_unconfirmed' 	=> TYPE_UNIXTIME,
		'dateend_unconfirmed' 		=> TYPE_UNIXTIME,
		'datestart_anonymous' 		=> TYPE_UNIXTIME,
		'dateend_anonymous' 		=> TYPE_UNIXTIME,
		'datestart_undisclosed' 	=> TYPE_UNIXTIME,
		'dateend_undisclosed' 		=> TYPE_UNIXTIME,
		'datestart_test' 			=> TYPE_UNIXTIME,
		'dateend_test' 				=> TYPE_UNIXTIME,				
	));
	
	$sqlconds = array();
	//CONFIRMED CONTRIBUTIONS
	if ($vbulletin->GPC['datestart_confirmed'])
	{
		$sqlconds[] = 'transaction.dateline >= ' . $vbulletin->GPC['datestart_confirmed'];
	}	
	if ($vbulletin->GPC['dateend_confirmed'])
	{
		$sqlconds[] = 'transaction.dateline <= ' . $vbulletin->GPC['dateend_confirmed'];
	}
	//UNCONFIRMED CONTRIBUTIONS
	if ($vbulletin->GPC['datestart_unconfirmed'])
	{
		$sqlconds[] = 'transaction.dateline >= ' . $vbulletin->GPC['datestart_unconfirmed'];
	}	
	if ($vbulletin->GPC['dateend_unconfirmed'])
	{
		$sqlconds[] = 'transaction.dateline <= ' . $vbulletin->GPC['dateend_unconfirmed'];
	}
	//ANONYMOUS CONTRIBUTIONS
	if ($vbulletin->GPC['datestart_anonymous'])
	{
		$sqlconds[] = 'transaction.dateline >= ' . $vbulletin->GPC['datestart_anonymous'];
	}	
	if ($vbulletin->GPC['dateend_anonymous'])
	{
		$sqlconds[] = 'transaction.dateline <= ' . $vbulletin->GPC['dateend_anonymous'];
	}
	//UNDISCLOSED CONTRIBUTIONS
	if ($vbulletin->GPC['datestart_undisclosed'])
	{
		$sqlconds[] = 'transaction.dateline >= ' . $vbulletin->GPC['datestart_undisclosed'];
	}	
	if ($vbulletin->GPC['dateend_undisclosed'])
	{
		$sqlconds[] = 'transaction.dateline <= ' . $vbulletin->GPC['dateend_undisclosed'];
	}
	//TEST CONTRIBUTIONS
	if ($vbulletin->GPC['datestart_test'])
	{
		$sqlconds[] = 'transaction.dateline >= ' . $vbulletin->GPC['datestart_test'];
	}	
	if ($vbulletin->GPC['dateend_test'])
	{
		$sqlconds[] = 'transaction.dateline <= ' . $vbulletin->GPC['dateend_test'];
	}		
				
if ($_REQUEST['action'] == 'download_confirmed')	
{
	// Query the database confirmed contributions
	$logs = $db->query_read("
		SELECT transaction.*, user.username, user.email
		FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations AS transaction
		LEFT JOIN " . TABLE_PREFIX . "user AS user ON(user.userid = transaction.userid)
		WHERE transaction.confirmed = " . ($vbulletin->GPC['status'] == 'noconfirmed' ? 0 : 1) . " AND transaction.testdon = " . ($vbulletin->GPC['status'] == 'notestdon' ? 0 : 0) . "
			" . (!empty($sqlconds) ? 'AND ' . implode("\r\n\tAND ", $sqlconds) : '') . "
		ORDER BY transaction.dateline ASC
	");
	} 
if ($_REQUEST['action'] == 'download_unconfirmed')	
{	
	// Query the database unconfirmed contributions		
	$logs = $db->query_read("
		SELECT transaction.*, user.username, user.email
		FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations AS transaction
		LEFT JOIN " . TABLE_PREFIX . "user AS user ON(user.userid = transaction.userid)
		WHERE transaction.confirmed = " . ($vbulletin->GPC['status'] == 'noconfirmed' ? 0 : 0) . "
			" . (!empty($sqlconds) ? 'AND ' . implode("\r\n\tAND ", $sqlconds) : '') . "
		ORDER BY transaction.dateline ASC
	");		
	}
if ($_REQUEST['action'] == 'download_anonymous')	
{	
	// Query the database anonymous contributions		
	$logs = $db->query_read("
		SELECT transaction.*, user.username, user.email
		FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations AS transaction
		LEFT JOIN " . TABLE_PREFIX . "user AS user ON(user.userid = transaction.userid)
		WHERE transaction.anonymous = " . ($vbulletin->GPC['status'] == 'noanonymous' ? 0 : 1) . "
			" . (!empty($sqlconds) ? 'AND ' . implode("\r\n\tAND ", $sqlconds) : '') . "
		ORDER BY transaction.dateline ASC
	");		
	}
if ($_REQUEST['action'] == 'download_undisclosed')	
{	
	// Query the database undisclosed contributions		
	$logs = $db->query_read("
		SELECT transaction.*, user.username, user.email
		FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations AS transaction
		LEFT JOIN " . TABLE_PREFIX . "user AS user ON(user.userid = transaction.userid)
		WHERE transaction.disclose = " . ($vbulletin->GPC['status'] == 'nodisclose' ? 0 : 0) . "
			" . (!empty($sqlconds) ? 'AND ' . implode("\r\n\tAND ", $sqlconds) : '') . "
		ORDER BY transaction.dateline ASC
	");		
	}
if ($_REQUEST['action'] == 'download_test')	
{	
	// Query the database test contributions		
	$logs = $db->query_read("
		SELECT transaction.*, user.username, user.email
		FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations AS transaction
		LEFT JOIN " . TABLE_PREFIX . "user AS user ON(user.userid = transaction.userid)
		WHERE transaction.testdon = " . ($vbulletin->GPC['status'] == 'notestdon' ? 0 : 1) . "
			" . (!empty($sqlconds) ? 'AND ' . implode("\r\n\tAND ", $sqlconds) : '') . "
		ORDER BY transaction.dateline ASC
	");		
	}				
	
	if ($db->num_rows($logs))
	{
		$a = $vbphrase['dbtech_vbdonate_trans_id'];
		$b = $vbphrase['dbtech_vbdonate_user'];
		$c = $vbphrase['dbtech_vbdonate_gross_amount'];
		$d = $vbphrase['dbtech_vbdonate_paypal_fee'];
		$e = $vbphrase['dbtech_vbdonate_net_amount'];
		$f = $vbphrase['dbtech_vbdonate_contrib_date'];
		$g = $vbphrase['dbtech_vbdonate_confirmed'];
		$h = $vbphrase['dbtech_vbdonate_ip_addy'];
		$i = $vbphrase['dbtech_vbdonate_email_addy'];
		$j = $vbphrase['dbtech_vbdonate_test_don'];
		$k = $vbphrase['dbtech_vbdonate_anon'];
		$l = $vbphrase['dbtech_vbdonate_disc'];
		//$filestring = "Transaction ID,Name,Amount,PP Fee,Net Amount,Date,Confirmed,IP Address,Email Address,Test Donation,Anonymus,Disclosed\r\n";
		$filestring = "$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l \r\n";
		while ($log = $db->fetch_array($logs))
		{
			
			// Add file string
			$filestring .= 
				'"' . str_replace('"', '""', $log['id']) . '",' . 
				'"' . str_replace('"', '""', $log['username']) . '",' .
				'"' . str_replace('"', '""', $log['amount']) . '",' . 
				'"' . str_replace('"', '""', $log['fee']) . '",' .
				'"' . str_replace('"', '""', $log['netamount']) . '",' .  
				'"' . str_replace('"', '""', vbdate($vbulletin->options['logdateformat'], $log['dateline'])) . '",' .
				'"' . str_replace('"', '""', ($log['confirmed'] ? $vbphrase['yes'] : $vbphrase['no'])) . '",' . 
				'"' . str_replace('"', '""', $log['userip']) . '",' .
				'"' . str_replace('"', '""', $log['email']) . '",' .				
				'"' . str_replace('"', '""', ($log['testdon'] ? $vbphrase['yes'] : $vbphrase['no'])) . '",' .
				'"' . str_replace('"', '""', ($log['anonymous'] ? $vbphrase['yes'] : $vbphrase['no'])) . '",' .				
				'"' . str_replace('"', '""', ($log['disclose'] ? $vbphrase['yes'] : $vbphrase['no'])) . '"' .  
			"\r\n";
		}
		
		// Now finally download the CSV
		require_once(DIR . '/includes/functions_file.php');
		if ($_REQUEST['action'] == 'download_confirmed')	
		{
			//DOWNLOAD CONFIRMED
			file_download($filestring, $vbphrase['dbtech_vbdonate_confirmed'] . ' ' . vbdate('m-d-y', $vbulletin->GPC['datestart_confirmed']) . ' to ' . vbdate('m-d-y', $vbulletin->GPC['dateend_confirmed']) . '.csv', 'text/csv');
		} 
		if ($_REQUEST['action'] == 'download_unconfirmed')	
		{		
			//DOWNLOAD UNCONFIRMED
			file_download($filestring, $vbphrase['dbtech_vbdonate_unconfirmed'] . ' ' . vbdate('m-d-y', $vbulletin->GPC['datestart_unconfirmed']) . ' to ' . vbdate('m-d-y', $vbulletin->GPC['dateend_unconfirmed']) . '.csv', 'text/csv');	
		}
		if ($_REQUEST['action'] == 'download_anonymous')	
		{		
			//DOWNLOAD ANONYMOUS
			file_download($filestring, $vbphrase['dbtech_vbdonate_anonymous'] . ' ' . vbdate('m-d-y', $vbulletin->GPC['datestart_anonymous']) . ' to ' . vbdate('m-d-y', $vbulletin->GPC['dateend_anonymous']) . '.csv', 'text/csv');	
		}
		if ($_REQUEST['action'] == 'download_undisclosed')	
		{		
			//DOWNLOAD UNDISCLOSED
			file_download($filestring, $vbphrase['dbtech_vbdonate_undisc'] . ' ' . vbdate('m-d-y', $vbulletin->GPC['datestart_undisclosed']) . ' to ' . vbdate('m-d-y', $vbulletin->GPC['dateend_undisclosed']) . '.csv', 'text/csv');	
		}
		if ($_REQUEST['action'] == 'download_test')	
		{		
			//DOWNLOAD TEST CONTRIBUTIONS
			file_download($filestring, $vbphrase['dbtech_vbdonate_test'] . ' ' . vbdate('m-d-y', $vbulletin->GPC['datestart_test']) . ' to ' . vbdate('m-d-y', $vbulletin->GPC['dateend_test']) . '.csv', 'text/csv');	
		}								
	}
	else
	{
		print_stop_message('no_results_matched_your_query');
	}	
}

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>