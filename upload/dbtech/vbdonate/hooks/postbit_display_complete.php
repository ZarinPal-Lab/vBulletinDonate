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

//START FIRST POST ONLY
if ($this->registry->options['dbtech_vbdonate_enable'] AND !is_member_of($vbulletin->userinfo, explode(',', $this->registry->options['dbtech_vbdonate_cantuse'])))
{
	if ($this->registry->options["dbtech_vbdonate_postbit_image"])	
	{
		if ($this->registry->options["dbtech_vbdonate_postbit_first_post"])
		{	
			if ($vbulletin->condition = $post[isfirstshown])
			{
				if ($this->registry->options["dbtech_vbdonate_postbit_auto"])
				{
					$donate_postbit = vB_Template::create('dbtech_vbdonate_postbit_donate');
					$donate_postbit->register('donate_postbit', $donate_postbit);
					switch ($this->registry->options['dbtech_vbdonate_postbit_auto'])
					{
						case 1: $template_hook['postbit_start'] .= $donate_postbit->render(); break;
						case 2: $template_hook['postbit_userinfo_left'] .= $donate_postbit->render(); break;
						case 3: $template_hook['postbit_userinfo_right_after_posts'] .= $donate_postbit->render(); break;
						case 4: $template_hook['postbit_userinfo_right'] .= $donate_postbit->render(); break;
						case 5: $template_hook['postbit_messagearea_start'] .= $donate_postbit->render(); break;
						case 6: $template_hook['postbit_signature_start'] .= $donate_postbit->render(); break;
						case 7: $template_hook['postbit_signature_end'] .= $donate_postbit->render(); break;
						case 8: $template_hook['postbit_controls'] .= $donate_postbit->render(); break;
					}	
				} 
				else 
				{
					$donate_postbit = vB_Template::create('dbtech_vbdonate_postbit_donate');
					$donate_postbit->register('donate_postbit', $donate_postbit);
					$template_hook['postbit_vbdonate_message'] .= $donate_postbit->render();	
				}
			}
		}		
	
//END FIRST POST ONLY/START ALL POST
	if (!$this->registry->options["dbtech_vbdonate_postbit_first_post"])
		{
			$donate_postbit = vB_Template::create('dbtech_vbdonate_postbit_donate');
			$donate_postbit->register('post', $post); 			
			switch ($this->registry->options['dbtech_vbdonate_postbit_auto'])
			{
				case 1: $template_hook['postbit_start'] .= $donate_postbit->render(); break;
				case 2: $template_hook['postbit_userinfo_left'] .= $donate_postbit->render(); break;
				case 3: $template_hook['postbit_userinfo_right_after_posts'] .= $donate_postbit->render(); break;
				case 4: $template_hook['postbit_userinfo_right'] .= $donate_postbit->render(); break;
				case 5: $template_hook['postbit_messagearea_start'] .= $donate_postbit->render(); break;
				case 6: $template_hook['postbit_signature_start'] .= $donate_postbit->render(); break;
				case 7: $template_hook['postbit_signature_end'] .= $donate_postbit->render(); break;
				case 8: $template_hook['postbit_controls'] .= $donate_postbit->render(); break;
			} 
		} 
		else 
		{
			$donate_postbit = vB_Template::create('dbtech_vbdonate_postbit_donate');
			$donate_postbit->register('donate_postbit', $donate_postbit);
			$template_hook['postbit_vbdonate_message'] .= $donate_postbit->render();	
		}
	}
}
	          
/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*\
<< ********************************************************************* >>
<< * Created: 09:30, Fri June 8th 2012                                 * >>
<< * VER: 1.0.0                                                        * >>
<< ********************************************************************* >>
\*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
?>