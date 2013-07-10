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

//DONATE FUNCTIONS
	if ($vbulletin->options['dbtech_vbdonate_don_amount']!='')
	{
		$dbt_vbd_pp_amt_start_srch = strpos($vbulletin->options['dbtech_vbdonate_don_amount'], ",");
		$dbt_vbd_pp_amt_start = substr($vbulletin->options['dbtech_vbdonate_don_amount'],0,$dbt_vbd_pp_amt_start_srch);

		if(strstr($dbt_vbd_pp_amt_start,'|'))
		{
			$dbt_vbd_pp_amt_start_srch2 = strpos($dbt_vbd_pp_amt_start, "|");
			$dbt_vbd_pp_amt_start = substr($dbt_vbd_pp_amt_start,0,$dbt_vbd_pp_amt_start_srch2);
		}
		$dbt_vbd_pp_amount_options = explode(',', $vbulletin->options['dbtech_vbdonate_don_amount']);
		$dbt_vbd_pp_amount_optionid = 0;
		
			foreach ($dbt_vbd_pp_amount_options AS $dbt_vbd_pp_amount_option)
			{
				$dbt_vbd_pp_amount_optionid += 1;
				$dbt_vbd_pp_amount_optionfirst = '';
				
					if ($dbt_vbd_pp_amount_optionid==1)
					{
						$dbt_vbd_pp_amount_optionfirst = 'selected="selected"';
					}
					if(strstr($dbt_vbd_pp_amount_option,'|'))
					{
						$dbt_vbd_pp_amount_optn = explode('|', $dbt_vbd_pp_amount_option);
						$dbt_vbd_pp_amt_opt .= '<option value="'.$dbt_vbd_pp_amount_option.'" '.$dbt_vbd_pp_amount_optionfirst.'>'.$dbt_vbd_pp_amount_optn[0].' </option>'."\n";
					}
					else
					{
						$dbt_vbd_pp_amt_opt .= '<option value="'.$dbt_vbd_pp_amount_option.'" '.$dbt_vbd_pp_amount_optionfirst.'>'.$dbt_vbd_pp_amount_option.'</option>'."\n";
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