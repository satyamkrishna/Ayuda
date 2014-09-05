<?php
	
	require '../../include/core.inc.php';
	require '../../include/loggedin.php';
	require '../../include/dbhelper.inc.php';
	require '../../include/help.inc.php';	
	
	$db = new dbHelper();
	$db->ud_connectToDB();
	
	if(isset($_POST['city_name'],$_POST['select_id']))
	{
		if(!empty($_POST['city_name']) &&!empty($_POST['select_id']))
		{
	
			$city_name = htmlentities($_POST['city_name']);
			$select_id = htmlentities($_POST['select_id']);
		
			$db->ud_getQuery('UPDATE `ud_user` SET `userCityID`= '.$select_id.' WHERE userCity LIKE \''.$city_name.'\'');
                        echo 'done';

		}
	}

?>