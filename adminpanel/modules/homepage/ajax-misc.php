<?php
require '../../include/core.inc.php';
	require '../../include/loggedin.php';
	require '../../include/dbhelper.inc.php';	
	$db = new dbHelper();
	$db->ud_connectToDB();
	
	if(isset($_POST['func'],$_POST['content']) && !empty($_POST['func']) && !empty($_POST['content']) && $_POST['func']=='whatwedo')
	{
		//Check Return
		$db->ud_updateQuery('ud_content', array('content'=>$_POST['content'],'modifiedBy'=>$_SESSION['userID'],'lastModified'=>$db->ud_timestamp()),array('contentPage'=>'What We Do'));
		echo "Ok";
	}
	else {
		echo "Invalid";
	}

?>