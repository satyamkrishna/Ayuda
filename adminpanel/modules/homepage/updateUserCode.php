<?php
	require '../../include/core.inc.php';
	require '../../include/loggedin.php';
	require '../../include/dbhelper.inc.php';	
	
	$db = new dbHelper();
	$db->ud_connectToDB();
	
	
	$result = $db->ud_whereQuery('ud_user',NULL,NULL,'AND',false,'ORDER BY  `ud_user`.`timestamp` ASC');
	$user = $db->ud_mysql_fetch_assoc_all($result);
	
	for($i=0;$i<sizeof($user);$i++)
	{
		$usercode = 'AYD'.getZero(($i+1)).($i+1);
		$db->ud_updateQuery('ud_user',array('userCode'=>$usercode),array('userID'=>$user[$i]['userID']));
	}
	
	function getZero($var)
	{
		$zero = '';
		for($i=0;$i<5-strlen($var);$i++)
		{
			$zero .=  '0';
		}
		return $zero;
	}
	
?>