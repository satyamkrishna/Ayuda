<?php

require '../../adminpanel/include/dbhelper.inc.php';
require '../../adminpanel/include/core.inc.php';
require '../../include/common/formdropdown.php';
require '../../include/common/header_link.php';


$db = new dbHelper();
$db -> ud_connectToDB();

$thankyou = 'location:'.$link_array['thankyou'];

if(isset($_POST['name'],$_POST['email'],$_POST['password'],$_POST['confirm_password'],$_POST['mobile'],
$_POST['institute'],$_POST['city'],$_POST['country'],$_POST['gender']))
{
	if(!empty($_POST['name']) &&!empty($_POST['email']) &&!empty($_POST['password']) &&!empty($_POST['confirm_password']))
	{
	
		$name = htmlentities($_POST['name']);
		$email = htmlentities($_POST['email']);
		$password = htmlentities($_POST['password']);
		$confirm_password = htmlentities($_POST['confirm_password']);
		$mobile = htmlentities($_POST['mobile']);
		$institute = htmlentities($_POST['institute']);
		$city = htmlentities($_POST['city']);
		$country = htmlentities($_POST['country']);
		$gender = htmlentities($_POST['gender']);
		
		$result = $db->ud_whereQuery('ud_user',array('userEmail'),array('userEmail'=>$email));
		$user_count = $db->ud_getRowCountResult($result);
		
		if($user_count == 0)
		{
			$result = $db->ud_whereQuery('ud_user',array('count(userEmail)+1 as count'));
			$user_count = $db->ud_mysql_fetch_assoc($result);
			
			$usercode = 'AYD'.getZero($user_count['count']).$user_count['count'];
			$db->ud_insertQuery('ud_user',array('userCode'=>$usercode,'userName'=>$name,'userEmail'=>$email,'userRole'=>1
					,'userPassword'=>md5($password),'userMobile'=>$mobile,'userInstitute'=>$institute
					,'userGender'=>$gender,'userCountryID'=>$country,'userCity'=>$city,'timestamp'=>$db->ud_timestamp()));
			
			header($thankyou);
		}
	}
}
// Terms And Conditions
$result = $db->ud_whereQuery('ud_content',null,array('contentPage'=>'Terms and Conditions'));
$terms = $db->ud_mysql_fetch_assoc($result);

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
<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
	<!--<![endif]-->

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width" />
		<title>Ayuda</title>
		<?php
		require '../../include/common/foundation.php';
		?>
		<link rel="stylesheet" href="../../resources/css/common/utopia.css" />

	</head>
	<body>

		<?php require '../../include/common/header-1.php'?>
		<?php
		require '../../include/common/header-2.php';
		?>
		<div class="content-wrapper">
			<div class="row page-title">
				<h2>Join Us</h2>
			</div>

			<form action="../../modules/homepage/joinus.php" method="post" id="form-join">
				<div class="row content" style="padding:20px;">
					<div class="large-6 columns hide-for-small">
						<div style="margin-left: 20px;margin-right: 20px;">
							<img style="width:100%;height:580px;padding-top: 40px;padding-bottom: 40px;" src="../../resources/images/signup/signup2.jpg">
						</div>
					</div>

					<div class="small-12 large-6 columns form">
						<p>Please fill in this short form to complete your registration.</p>
						<hr />
						<div class="row">
							<div class="large-3 columns hide-for-small">
								<label for="name" class="inline right">Name</label>
								<label for="email" class="inline right">Email</label>
								<label class="inline right">Password</label>
								<label class="inline right">Re - Enter</label>
								<label class="inline right">Mobile</label>
								<label class="inline right">Institute</label>
								<label class="inline right">City</label>
								<label class="inline right">Country</label>
							</div>
							<div class="small-12 large-8 columns">
								<input id="name" class="required" name="name" type="text" placeholder="Name" />
								<input id="email" class="required" name="email" type="email" placeholder="Email-Address" />
								<input id="password" class="required" name="password" type="password" placeholder="Password" />
								<input id="confpassword" class="required" name="confirm password" type="password" placeholder="Confirm Password" />
								<input id="mobile" name="mobile" type="text" placeholder="8148970027" />
								<input id="institute" name="institute" type="text" placeholder="VIT Vellore" />
								<input id="city" class="required" name="city" type="text" placeholder="Vellore" />
								<?php echo ud_general_country(); ?>
							</div>
							<div class="large-1 columns">

							</div>
						</div>
						<div class="row">
							<div class="small-4 large-3 columns">
								<label class="inline right">Gender</label>
							</div>
							<div class="small-8 large-8 columns gender">
								<label >Male</label>
								<input  type="radio" name="gender" value="M" placeholder="Name" checked="checked"/>
								<label >Female</label>
								<input  type="radio" name="gender" value="F"  placeholder="Name" />
							</div>
							<div class="large-1 columns">

							</div>
						</div>
						<div class="row">
							<div class="large-offset-3 large-8 columns">
								<input  id="signup" type="button" class="button" value="Sign Up" />
							</div>
							<div class="large-1 columns">

							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<a class="reveal-link" data-reveal-id="myModal"></a>
		<div id="myModal" class="reveal-modal text">
			<h2>Terms and Conditions</h2>
			<div class="tandc">	
				<?php echo $terms['content'];?>	
			<div class="accepttandc">				
				<label>Accept Terms and Conditions</label>				
				<input id="accept" type="checkbox" />
				<input id="confirmreg" type="button" class="button"  value="Confirm Registration"/>
			</div>
			
			
			</div>
			<a class="close-reveal-modal">&#215;</a>
		</div>

		<?php
		require '../../include/common/footer.php';
		?>
		<script src="../../resources/js/pages/joinus.js" type="text/javascript"></script>
	</body>
</html>
