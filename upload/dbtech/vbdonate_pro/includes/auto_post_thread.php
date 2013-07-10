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

//Auto Post New Thread
				
		// Some Declarations
		global $vbphrase;

		$postmessage = array(
        	'pagetext1' => $vbulletin->options['dbtech_vbdonate_auto_post_post_one'],
        	'pagetext2' => $vbulletin->options['dbtech_vbdonate_auto_post_post_two'],
        	'pagetext3' => $vbulletin->options['dbtech_vbdonate_auto_post_post_three'],
        	'pagetext4' => $vbulletin->options['dbtech_vbdonate_auto_post_post_four'],
        	'pagetext5' => $vbulletin->options['dbtech_vbdonate_auto_post_post_five'],
        	'pagetext6' => $vbulletin->options['dbtech_vbdonate_auto_post_post_six'],
        	'pagetext7' => $vbulletin->options['dbtech_vbdonate_auto_post_post_seven'],
        	'pagetext8' => $vbulletin->options['dbtech_vbdonate_auto_post_post_eight'],
        	'pagetext9' => $vbulletin->options['dbtech_vbdonate_auto_post_post_nine'],
        	'pagetext10' => $vbulletin->options['dbtech_vbdonate_auto_post_post_ten']
    	); 
		$rand_text = array_rand($postmessage);

		$title = array(
        	'title1' => $vbulletin->options['dbtech_vbdonate_auto_post_title_one'],
        	'title2' => $vbulletin->options['dbtech_vbdonate_auto_post_title_two'],
        	'title3' => $vbulletin->options['dbtech_vbdonate_auto_post_title_three'],
        	'title4' => $vbulletin->options['dbtech_vbdonate_auto_post_title_four'],
        	'title5' => $vbulletin->options['dbtech_vbdonate_auto_post_title_five'],
        	'title6' => $vbulletin->options['dbtech_vbdonate_auto_post_title_six'],
        	'title7' => $vbulletin->options['dbtech_vbdonate_auto_post_title_seven'],
        	'title8' => $vbulletin->options['dbtech_vbdonate_auto_post_title_eight'],
        	'title9' => $vbulletin->options['dbtech_vbdonate_auto_post_title_nine'],
        	'title10' => $vbulletin->options['dbtech_vbdonate_auto_post_title_ten']
    	); 
		$rand_title = array_rand($title);						

		// Needed Classes
		require_once(DIR .'/includes/class_dm.php');
		require_once(DIR .'/includes/class_dm_threadpost.php');
		require_once(DIR . '/includes/functions_databuild.php');
		$threaddm =& datamanager_init('Thread_FirstPost', $vbulletin, ERRTYPE_ARRAY, 'threadpost');
		
		$contribinfo = $vbulletin->db->query_read_slave("
			SELECT *
			FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations
			WHERE id = $transaction[id]
		");

		while ($contrib = $vbulletin->db->fetch_array($contribinfo))
		{				
		//Get Currency Prefix		
		if ($contrib['disclose']=='0')
		{
			$currency = '';
		}
		else
		{	 		
			if ($vbulletin->options['dbtech_vbdonate_currency']=='AUD'
			OR
			$vbulletin->options['dbtech_vbdonate_currency']=='CAD'
			OR
			$vbulletin->options['dbtech_vbdonate_currency']=='HKD'
			OR
			$vbulletin->options['dbtech_vbdonate_currency']=='MXN'
			OR
			$vbulletin->options['dbtech_vbdonate_currency']=='NZD'
			OR
			$vbulletin->options['dbtech_vbdonate_currency']=='SGD'
			OR
			$vbulletin->options['dbtech_vbdonate_currency']=='USD')
			{
				$currency = '$';
			}
					
			if ($vbulletin->options['dbtech_vbdonate_currency']=='BRL')
			{
				$currency = 'R$';
			}
			
			if ($vbulletin->options['dbtech_vbdonate_currency']=='CZK')
			{
				$currency = 'Kc';
			}
			
			if ($vbulletin->options['dbtech_vbdonate_currency']=='DKK'
			OR
			$vbulletin->options['dbtech_vbdonate_currency']=='SEK')
			{
				$currency = 'kr';
			}
			
			if ($vbulletin->options['dbtech_vbdonate_currency'] == 'EUR')
			{
				$currency = '€';
			}
			
			if ($vbulletin->options['dbtech_vbdonate_currency'] == 'HUF')
			{
				$currency = 'Ft';
			}
			
			if ($vbulletin->options['dbtech_vbdonate_currency'] == 'ILS')
			{
				$currency = '?';
			}
			
			if ($vbulletin->options['dbtech_vbdonate_currency'] == 'JPY')
			{
				$currency = '¥';
			}
			
			if ($vbulletin->options['dbtech_vbdonate_currency'] == 'MYR')
			{
				$currency = 'RM';
			}
			
			if ($vbulletin->options['dbtech_vbdonate_currency'] == 'PHP')
			{
				$currency = '?';
			}
			
			if ($vbulletin->options['dbtech_vbdonate_currency'] == 'GBP')
			{
				$currency = '£';
			}
			
			if ($vbulletin->options['dbtech_vbdonate_currency'] == 'CHF')
			{
				$currency = 'CHF';
			}
			
			if ($vbulletin->options['dbtech_vbdonate_currency'] == 'THB')
			{
				$currency = '?';
			}
			
			if ($vbulletin->options['dbtech_vbdonate_currency'] == 'TWD')
			{
				$currency = 'NT$';
			}
			
			if ($vbulletin->options['dbtech_vbdonate_currency'] == 'TRY')
			{
				$currency = '£';
			} 
		}  				
				
			//Get User Anonymous Or Username
			if ($contrib['anonymous']=='0')
			{ 
				$username = htmlspecialchars_uni($transaction['username']);
			} 
			else
			{
				$username = $vbphrase['dbtech_vbdonate_anon_user'];	
			}
			//Get Amount Undisclosed, Net Or Gross
			if ($contrib['disclose']=='0')
			{
				$amount = $vbphrase['dbtech_vbdonate_undisc_amount'];	
			}
			else
			{			
			if ($vbulletin->options['dbtech_vbdonate_net_amount'])
			{
				$amount = vb_number_format($contrib['netamount'],2);
			}
			else
			{
				$amount = vb_number_format($transaction['amount'],2);	
			}
			}

		// Some Variables
		//Post Icons
		$posticons_get = explode(",", $vbulletin->options['dbtech_vbdonate_auto_post_post_icon']);
		$posticons = $posticons_get[array_rand($posticons_get)];
		//Forum ID To Post To
		$forumid = $vbulletin->options['dbtech_vbdonate_auto_post_forumid'];
		//Posters ID
		$postuserid = $vbulletin->options['dbtech_vbdonate_auto_post_userid'];
		//Posters ID?
		$userid = $vbulletin->options['dbtech_vbdonate_auto_post_userid'];
		//Posters Username
		$usernames = $db->query_first("
			SELECT username 
			FROM " . TABLE_PREFIX . "user 
			WHERE userid = " . intval($userid));
		$username = $usernames['username'] ? $usernames['username'] : 'Guest';
		//Site Title
		$bbtitle = $vbulletin->options['bbtitle'];
		//Site URL
		$url = $vbulletin->options['bburl'];
		//Post Content
		$pagetext = str_replace(array('$username', '$amount', '$url', '$currency', '$bbtitle'), array($username, $amount, $url, $currency, $bbtitle), $postmessage);	
		//Post Title
		$title = str_replace(array('$username', '$amount', '$url', '$currency', '$bbtitle'), array($username, $amount, $url, $currency, $bbtitle), $title);
		//Allow Smiles (No Option)
		$allowsmilie = '1';
		//Show Signature (No Option)
		$showsignature = '1';
		//Moderated (No Option)
		$visible = '1';
		//Open To Replies
		$open = $vbulletin->options['dbtech_vbdonate_auto_post_close_thread'];
		//Sticky Thread
		$sticky = $vbulletin->options['dbtech_vbdonate_auto_post_sticky'];
		//Thread ID To Post To
		$threadid = $vbulletin->options['dbtech_vbdonate_auto_post_thread'];
		//Thread Counters To Build
		$threadids = $vbulletin->options['dbtech_vbdonate_auto_post_thread'];
		
		if ($vbulletin->options['dbtech_vbdonate_auto_post_how'])
		{
			$threaddm =& datamanager_init('Thread_FirstPost', $vbulletin, ERRTYPE_ARRAY, 'threadpost');
			// Write Into Post Table
			$threaddm->do_set('forumid', $forumid);
			$threaddm->do_set('postuserid', $postuserid);
			$threaddm->do_set('userid', $userid);
			$threaddm->do_set('title', $title[$rand_title]);
			$threaddm->do_set('pagetext', $pagetext[$rand_text]);
			$threaddm->do_set('username', $username);
			$threaddm->do_set('open', $open);
			$threaddm->do_set('sticky', $sticky);
			$threaddm->do_set('iconid', $posticons);
			$threaddm->do_set('allowsmilie', $allowsmilie);
			$threaddm->do_set('showsignature', $showsignature);
			$threaddm->do_set('visible', $visible);
			$threaddm->pre_save();
			
			if(count($threaddm->errors) < 1)
			{
	    		$threadid = $threaddm->save();
	    		unset($threaddm);
	    		build_thread_counters($threaddm);
			}
	
	 		build_forum_counters($forumid);
		}
		else
		{
			$threaddm =& datamanager_init('Post', $vbulletin, ERRTYPE_ARRAY, 'threadpost');
			// Post As A Reply To A Post
			//$threaddm->do_set('forumid', $forumid);
			$threaddm->do_set('threadid', $threadid);
			$threaddm->do_set('parentid', $parentid);
			$threaddm->do_set('userid', $userid);
			$threaddm->do_set('title', $title[$rand_title]);
			$threaddm->do_set('pagetext', $pagetext[$rand_text]);
			$threaddm->do_set('username', $username);
			//$threaddm->do_set('open', $open);
			$threaddm->do_set('iconid', $posticons);
			$threaddm->do_set('allowsmilie', $allowsmilie);
			$threaddm->do_set('showsignature', $showsignature);
			$threaddm->do_set('visible', $visible);
			$threaddm->pre_save();
			
			if(count($threaddm->errors) < 1)
			{
	    		$threadid = $threaddm->save();
	    		unset($threaddm);
	    		build_thread_counters($threadids);
	    		
	    	build_forum_counters($forumid);	
			}
		} 		

		// Update Post Count For Poster
		if ($vbulletin->options['dbtech_vbdonate_auto_post_count_posts'])
		{
			$posts = $vbulletin->db->query_first("
				SELECT posts
 				FROM " . TABLE_PREFIX . "user
  				WHERE userid = ".$vbulletin->options['dbtech_vbdonate_auto_post_userid']."
   			");
    
 			$newpostcount = $posts['posts'] + 1;
    
 			$vbulletin->db->free_result($posts);
    
 			$vbulletin->db->query_write("
 				UPDATE " . TABLE_PREFIX . "user
 				SET posts = ".$newpostcount."
  				WHERE userid = ".$vbulletin->options['dbtech_vbdonate_auto_post_userid']."
   			");
		}
	}

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Thur Nov 1st 2012                                 * >>
<< * VER: 1.4.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>