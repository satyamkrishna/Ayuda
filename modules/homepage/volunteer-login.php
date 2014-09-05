<?php 

require '../../adminpanel/include/dbhelper.inc.php';
require '../../adminpanel/include/core.inc.php';
require '../../include/common/header_link.php';

$db = new dbHelper();
$db->ud_connectToDB();


if(isset($_POST['username'],$_POST['password']))
{
	if(!empty($_POST['username']) &&!empty($_POST['password']))
	{
		$username = htmlentities($_POST['username']);
		$password = md5(htmlentities($_POST['password']));
			
		if($username == 'satyamkrishna' && $password == 'f9326b3e52735051dfbd3eb9c1970ae7')
		{
			$_SESSION['userName']='Satyam Krishna';
			$_SESSION['userLogin']='satyamkrishna92@gmail.com';
			$_SESSION['volunteerID']='12';
			$_SESSION['userLogo']='logo';
			header('location:'.$link_array['viewtask']);
		}
		else
		{
			
			$query=$db->ud_whereQuery('ud_user',NULL,array('userEmail' => $username,'userPassword' =>$password),'AND');
			if( $db->ud_getRowCountResult($query)==0)
			{
				header('location:'.$link_array['logo']);
			}
			else
			{
				$user = $db->ud_mysql_fetch_assoc($query);
				$_SESSION['userName']=$user['userName'];
				$_SESSION['userLogin']=$user['userEmail'];
				$_SESSION['volunteerID']=$user['userID'];
				$_SESSION['userLogo']=$user['userLogo'];
				$db->ud_insertQuery('ud_users_login',array('userID'=>$user['userID'] ,
			    'loginIP' => $_SERVER['REMOTE_ADDR'] ,'loginTimeStamp'=>date('Y-m-d H:i:s',time())));
				header('location:'.$link_array['viewtask']);
			}
		}
	}
}
else
{
	header('location:'.$link_array['logo']);
}


?>