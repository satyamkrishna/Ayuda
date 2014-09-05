<?php 

require '../../adminpanel/include/core.inc.php';
require '../../adminpanel/include/dbhelper.inc.php';
require '../../include/common/header_link.php';

if(ud_user_loggedin())
{
	header('location:addtask.php');
}

$db = new dbHelper();
$db->ud_connectToDB();

$header_loc = 'location:back';
if($_SERVER['SERVER_ADDR'] == '127.0.0.1')
{
	$header_loc = 'location:backsoon.php';
}
	
	if(isset($_POST['username'],$_POST['password']))
	{
		if(!empty($_POST['username']) &&!empty($_POST['password']))
		{
		
			$username = htmlentities($_POST['username']);
			$password = md5(htmlentities($_POST['password']));
			
			$query=$db->ud_whereQuery('ud_user',NULL,array('userEmail' => $username,'userPassword' =>$password));
			if( $db->ud_getRowCountResult($query)==0)
			{
				$login = false;
			}
			else
			{
				$user = $db->ud_mysql_fetch_assoc($query);
				/*
				$_SESSION['userName']=$db->ud_mysql_result($query, 0,'userName');	
				$_SESSION['userLogin']=$db->ud_mysql_result($query, 0,'userEmail');	
				$_SESSION['emailID']=$db->ud_mysql_result($query, 0,'userID');
				$_SESSION['userLogo']=$db->ud_mysql_result($query, 0,'userLogo');
				*/
				$db->ud_insertQuery('ud_users_login',array('userID'=>$user['userID'] , 'loginIP' => $_SERVER['REMOTE_ADDR'] ,'loginTimeStamp'=>date('Y-m-d H:i:s',time())));
				header($header_loc);		
			}
		}
		else
		{
			header('location:'.$link_array['login']);
		}
	}
	
	if(isset($_SESSION['emailID']) && !empty($_SESSION['emailID']))
	{
		header($header_loc);
	}
	
	
?>
<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width" />
<title>Ayuda</title>
<?php require '../../include/common/foundation.php';?>
<link rel="stylesheet" href="../../resources/css/common/utopia.css" />
</head>
<body>
<?php require '../../include/common/header-1.php'?>
<?php require '../../include/common/header-2.php';?>
<div class="content-wrapper">
	<div class="row page-title">
		<h2>Login</h2>
	</div>
	<div class="row content login-box">
		<div class="large-6 columns large-centered">
			<p>Login to Add a Task</p>
			<form action="login.php" method="post">
				<div class="row">
					<div class="large-2 columns">
						<label class="inline">Username</label>
						<label class="inline">Password</label> </div>
					<div class="large-6 columns">
						<input name="username" placeholder="utopiadeveloper" type="text" />
						<input name="password" placeholder="" type="password" />
					</div>
					<div class="large-4 columns">
					</div>
				</div>
				<input type="submit" value="Log In" class="button">
			</form>
		</div>
		<div class="large-6 columns"></div>
	</div>
</div>
<?php require '../../include/common/footer.php';?>
</body>
</html>
