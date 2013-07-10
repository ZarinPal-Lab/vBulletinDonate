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


	if ($vbulletin->options['dbtech_vbdonate_banner_slider'])
	{
 		$vbbannertimeout = $vbulletin->options['dbtech_vbdonate_banner_timeout'];
		if (THIS_SCRIPT == 'vbcms')
		{
			$custom = $vbulletin->db->query_read("SELECT custom.contentid, custom.publishdate, custom.title, custom.previewimage, custom.active, custom.in_cms, custom.in_forum
				FROM " . TABLE_PREFIX . "dbtech_vbdonate_slider AS custom
				WHERE 1 =1
				AND custom.active =1
				AND custom.in_cms =1
				AND custom.publishdate <= " . TIMENOW . "
			");
		} 
		else 
		{
			$custom = $vbulletin->db->query_read("SELECT custom.contentid, custom.publishdate, custom.title, custom.previewimage, custom.active, custom.in_cms, custom.in_forum
				FROM " . TABLE_PREFIX . "dbtech_vbdonate_slider AS custom
				WHERE 1 =1
				AND custom.active =1
				AND custom.in_forum =1
				AND custom.publishdate <= " . TIMENOW . "
			");
		}	

		if ($vbulletin->db->num_rows($custom) > 0)
		{
			while($rowcustom = $vbulletin->db->fetch_array($custom)){
				$rows[] = array(
					'contentid'	    => $rowcustom['contentid'],  
					'nodeid'		=> '',  
					'publishdate'	=> $rowcustom['publishdate'], 
					'title'			=> $rowcustom['title'], 
					'previewimage'	=> $rowcustom['previewimage'], 
					'in_cms'		=> $rowcustom['in_cms'],
					'in_forum'		=> $rowcustom['in_forum'],	
					'type'			=> 'custom');
		}
	}
//Output the content to the widget

	if ($vbbannertimeout == '')
	{
   	 $vbbannertimeout=5000;
	}
	if ($vbulletin->options['dbtech_vbdonate_loadjquery'])
	{
		$static = '<script src="http://ajax.googleapis.com/ajax/libs/jquery/' . $vbulletin->options['dbtech_vbdonate_jquery_version'] . '/jquery.min.js" type="text/javascript"></script>';
	}
/*$static .='<script src="dbtech/vbslider/clientscript/s3Slider.js" type="text/javascript"></script>
<script type="text/javascript">
$.noConflict(true)(function($)  
	{
		$(\'#slider1\').s3Slider({
			timeOut: ' . $vbbannertimeout . '
		});
	});
</script>';*/
	$static .='<script src="dbtech/vbdonate/clientscript/s3Slider.js" type="text/javascript"></script>
		<script type="text/javascript">
		jQuery.noConflict();  
		jQuery(document).ready(function() {
		jQuery(\'#slider1\').s3Slider({
		timeOut: ' . $vbbannertimeout . '
		});
	});
	</script>';
	$static .='<div id="slider1">';
	$static .='   <ul id="slider1Content">';

		for($i = 0; $i < count($rows); $i++)
		{ 
			if(strlen($rows[$i]['previewimage']) < 1)
			{
				$span .= '" style="height:0px; width:0px; padding:0px;';
			}
			$static .='      <li class="slider1Image" >';
			$static .='          <img src="' . $vbulletin->options['bburl'] . '/dbtech/vbdonate/images/banners/' . $rows[$i]['previewimage'] . '" alt="'.$vbulletin->options ['dbtech_vbdonate_banner_alt'].'" />';
			$static .='          <span class="' . $span . '"/>';
		}
			$static .='      <div class="clear slider1Image" />';
			$static .='      </li>';
			$static .='   </ul>';
			$static .='</div>';
			$output['texts'] = $static;
	}

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>