<?php 

function ud_general_country()
{
	$name = "country";
	$selected_option = 77;
	$select = '<select name="'.$name.'" class="medium" style="height:31px;">';
	if(false)
	{
		$select .= '<option value="-1">Select a Country</option>';
	}
	$db = new dbHelper();
	$db->ud_connectToDB();
	$result = $db->ud_whereQuery('`ud_general_country`',NULL,array('thrashed'=>0),'AND',false,'ORDER BY countryName ASC');
	$country = $db->ud_mysql_fetch_assoc_all($result);
	for($i=0;$i<sizeof($country);$i++)
	{
		$option_selected = '';
		if($country[$i]['countryID'] == $selected_option)
		{
			$option_selected = ' selected="selected" ';
		}
		$select .= '<option '.$option_selected.' value="'.$country[$i]['countryID'].'">'.$country[$i]['countryName'].'</option>';
	}
	
	$select .= '</select>';
	
	
	return $select;
}

?>