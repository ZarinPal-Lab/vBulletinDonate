<?php
	
class vB_BlockType_dbtech_vbdonate extends vB_BlockType
{
	/**
	 * The Productid that this block type belongs to
	 * Set to '' means that it belongs to vBulletin forum
	 *
	 * @var string
	 */
	protected $productid = 'dbtech_vbdonate';
	
	/**
	 * The block settings
	 * It uses the same data structure as forum settings table
	 * e.g.:
	 * <code>
	 * $settings = array(
	 *     'varname' => array(
	 *         'defaultvalue' => 0,
	 *         'optioncode'   => 'yesno'
	 *         'displayorder' => 1,
	 *         'datatype'     => 'boolean'
	 *     ),
	 * );
	 * </code>
	 * @see print_setting_row()
	 *
	 * @var string
	 */
	protected $settings = array(
		'dbtech_vbdonate_limit' => array(
			'defaultvalue' => 5,
			'displayorder' => 2,
			'datatype'     => 'integer'
		),
		'dbtech_vbdonate_display_type' => array(
			'defaultvalue' => 1,
			'optioncode'   => 'radio:piped
1|dbtech_vbdonate_latest
2|dbtech_vbdonate_highest',
			'displayorder' => 1,
			'datatype'     => 'integer'
		),
	);
	
	public static function contenttypeIdChooser($topname = null)
	{
		$selectoptions = array();

		if ($topname)
		{
			$selectoptions['-1'] = $topname;
		}
		
		foreach ((array)VBDONATE::$cache['contenttype'] as $contenttypeid => $contenttype)
		{
			if (!$contenttype['active'])
			{
				// Skip inactive contenttypes
				continue;
			}
			
			// Add to select options
			$selectoptions[$contenttypeid] = $contenttype['title'];
		}

		return $selectoptions;
	}	

	public function getData()
	{
		if (intval($this->config['dbtech_vbdonate_display_type']) == 1)
		{
			//Each Recent Donation
			$donations = $this->registry->db->query_read_slave("
				SELECT
					donations.amount AS total_amount,
					donations.netamount AS net_total_amount,
					donations.*,
					user.*
					" . ($this->registry->options['avatarenabled'] ? ',avatar.avatarpath, NOT ISNULL(customavatar.userid) AS hascustomavatar, customavatar.dateline AS avatardateline,customavatar.width AS avwidth,customavatar.height AS avheight' : '') . "
				FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations AS donations
				LEFT JOIN " . TABLE_PREFIX . "user AS user ON(user.userid = donations.userid)
				" . ($this->registry->options['avatarenabled'] ? 'LEFT JOIN ' . TABLE_PREFIX . 'avatar AS avatar ON(avatar.avatarid = user.avatarid) LEFT JOIN ' . TABLE_PREFIX . 'customavatar AS customavatar ON(customavatar.userid = user.userid)' : '') . "
				WHERE donations.confirmed = 1
				ORDER BY donations.dateline DESC 
				LIMIT " . intval($this->config['dbtech_vbdonate_limit'])
			);				
		}
		else
		{
			//Running Total Donations
			$donations = $this->registry->db->query_read_slave("
				SELECT 
					SUM(donations.amount) AS total_amount,
					SUM(donations.netamount) AS net_total_amount,
					donations.*,
					user.*
					" . ($this->registry->options['avatarenabled'] ? ',avatar.avatarpath, NOT ISNULL(customavatar.userid) AS hascustomavatar, customavatar.dateline AS avatardateline,customavatar.width AS avwidth,customavatar.height AS avheight' : '') . "
				FROM " . TABLE_PREFIX . "dbtech_vbdonate_donations AS donations
				LEFT JOIN " . TABLE_PREFIX . "user AS user ON(user.userid = donations.userid)
				" . ($this->registry->options['avatarenabled'] ? 'LEFT JOIN ' . TABLE_PREFIX . 'avatar AS avatar ON(avatar.avatarid = user.avatarid) LEFT JOIN ' . TABLE_PREFIX . 'customavatar AS customavatar ON(customavatar.userid = user.userid)' : '') . "
				WHERE donations.confirmed = 1 AND donations.disclose = 1 AND donations.anonymous = 0
				GROUP BY donations.userid 
				ORDER BY total_amount DESC 
				LIMIT " . intval($this->config['dbtech_vbdonate_limit'])
			);
		}

		while ($donation = $this->registry->db->fetch_array($donations))
		{
			// get avatar
			$this->fetch_avatarinfo($donation);
			
			if (strlen($donation['username']) > $this->registry->options['dbtech_vbdonate_char_limit'])
			{
				$change_userinfo['username'] = substr($donation['username'],0,$this->registry->options['dbtech_vbdonate_char_limit']);
				$change_userinfo['usergroupid'] = $donation['usergroupid'];
				$change_userinfo['membergroupids'] = $donation['membergroupids'];
				fetch_musername($change_userinfo);
				$donation['username'] = $change_userinfo['musername'];
			}
			else
			{
				fetch_musername($donation);
				$donation['username'] = $donation['musername'];
			}
			
			$donatearray[] = $donation;
		}		

		return $donatearray;
	}

	public function getHTML($donatearray = false)
	{
		if (!$donatearray)
		{	
			$donatearray = $this->getData();
		}
  
		foreach ((array)$donatearray AS $data)
		{			
			$templater = vB_Template::create('dbtech_vbdonate_sideblock_bits');
				$templater->register('data', $data);
			$content .= $templater->render();
		}   	

		$templater = vB_Template::create((intval($this->config['dbtech_vbdonate_display_type']) == 1 ? 'dbtech_vbdonate_sideblock' : 'dbtech_vbdonate_sideblock_total'));
			$templater->register('content', $content);
		return $templater->render();				
	}	
	
	/**
	 * Generates a hash used for block caching.
	 * If the block output depends on permissions,
	 * ensure it's unique either per-user or for all
	 * users with similar permissions
	 *
	 * @return string 	The hash
	 */
	public function getHash()
	{
		$context = new vB_Context('forumblock' ,
		array(
			'blockid' 	=> $this->blockinfo['blockid'],
			'permissions' 	=> $this->userinfo['forumpermissions'],
			'ignorelist' 	=> $this->userinfo['ignorelist'],
			THIS_SCRIPT)
		);

		return strval($context);
	}
}