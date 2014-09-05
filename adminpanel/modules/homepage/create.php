<?php
	require '../../include/core.inc.php';
	require '../../include/loggedin.php';
	require '../../include/dbhelper.inc.php';
	require '../../include/createCertificateImage.php';	
	require '../../../include/common/createCertificatePDF.php';
	
	$db = new dbHelper();
	$db->ud_connectToDB();

	$result = $db->ud_whereQuery('ud_user');
	$user = $db->ud_mysql_fetch_assoc_all($result);
	
	$obj = new createImage();
	$obj1 = new createPDF();
	
	
	for($i=0;$i<sizeof($user);$i++)
	{
		$file = '../../upload/certificate/'.$user[$i]['userCode'].'.jpg';
		$obj->createCertificateImage(getName($user[$i]['userName']),$user[$i]['userCode'],$file,false);
		//$obj1->createCertificatePDF($file);
		
	}
	
	function getName($var)
	{
		return ucwords(strtolower($var));
	}
?>