<?php

	require '../../include/core.inc.php';
	require '../../include/dbhelper.inc.php';
	
	$file_path = '../../';
	
	$db = new dbHelper;
	$db->ud_connectToDB();	
	
	if(isset($_POST['username'],$_POST['password']))
	{
		if(!empty($_POST['username']) &&!empty($_POST['password']))
		{
		
			$username = htmlentities($_POST['username']);
			$password = md5(htmlentities($_POST['password']));
			
			$query=$db->ud_whereQuery('ud_admin_users',NULL,array('userLogin' => $username,'userPassword' =>$password));
			if( $db->ud_getRowCountResult($query)==0)
			{
				$login = false;
			}
			else
			{
				$_SESSION['userName']=$db->ud_mysql_result($query, 0,'userName');	
				$_SESSION['userLogin']=$db->ud_mysql_result($query, 0,'userLogin');	
				$_SESSION['userID']=$db->ud_mysql_result($query, 0,'userID');
				$_SESSION['userLogo']=$db->ud_mysql_result($query, 0,'userLogo');
				$db->ud_insertQuery('ud_admin_users_login',array('userID'=>$_SESSION['userID'] , 'loginIP' => $_SERVER['REMOTE_ADDR'] ,'loginTimeStamp'=>date('Y-m-d H:i:s',time())));
				header('location:../homepage/index.php');		
			}
		}
	}
	
	if(isset($_SESSION['userID']) && !empty($_SESSION['userID']))
	{
		header('location:../homepage/index.php');
	}
	
?>
<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en">

<![endif]--><!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en">

<![endif]--><!--[if IE 8]>
<html class="no-js lt-ie9" lang="en">

<![endif]--><!--[if gt IE 8]>
<!-->
<html class="no-js" lang="en">

<!--<![endif]-->
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Login - Ayuda</title>
<!-- Metadata -->
<meta content="" name="description" />
<meta content="" name="keywords" />
<meta content="" name="author" />
<?php require '../../include/foundation.php'; ?>
<!-- CSS Styles -->
<link rel="stylesheet" href="../../resources/css/frontend/homepage/login.css"/> 
</head>

<body>
<?php require '../../include/header.php'; ?>
<form action="index.php" method="post" style="margin-top: 100px; margin-bottom: 110px;">
	<div class="row">
		<div class="large-7 columns login-box large-centered">
			<h3>Log In</h3>
			<hr />
			<div class="row">
				<div class="large-3 columns">
					<label class="right inline">Username</label>
					<label class="right inline">Password</label> </div>
				<div class="large-8 columns">
					<input name="username" placeholder="utopiadeveloper" type="text" />
					<input name="password" placeholder="" type="password" />
				</div>
				<div class="large-1 columns">
				</div>
			</div>
			<div class="row">
				<div class="large-offset-3 large-3 columns">
					<button class="button login-button">Log in</button></div>
				<div class="large-6 columns" style="margin-top: 10px;">
					<a class="left inline" href="#"><!-- Forget Your Password? --></a>
				</div>
			</div>
		</div>
	</div>
</form>
<?php require '../../include/footer.php'; ?>
</body>
</html>
<![endif]-->