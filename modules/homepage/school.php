<?php 

require '../../adminpanel/include/dbhelper.inc.php';
require '../../adminpanel/include/core.inc.php';
require '../../include/common/formdropdown.php';
require '../../include/common/header_link.php';


$db = new dbHelper();
$db->ud_connectToDB();

// Terms And Conditions
$result = $db->ud_whereQuery('ud_content',null,array('contentPage'=>'Terms and Conditions'));
$terms = $db->ud_mysql_fetch_assoc($result);


$thankyou = 'location:'.$link_array['thankyous'];

if(isset($_POST['schoolName'],$_POST['contactName'],$_POST['contactEmail'],$_POST['contactPassword'],$_POST['confirm_password'],
		$_POST['contactNumber'],$_POST['city'],$_POST['country']))
{
	
	$schoolName = htmlentities($_POST['schoolName']);
	$contactName = htmlentities($_POST['contactName']);
	$contactEmail = htmlentities($_POST['contactEmail']);
	$contactPassword = htmlentities($_POST['contactPassword']);
	$confirm_password = htmlentities($_POST['confirm_password']);
	$contactNumber = htmlentities($_POST['contactNumber']);
	$city = htmlentities($_POST['city']);
	$country = htmlentities($_POST['country']);
	
	$result = $db->ud_whereQuery('ud_schools',array('contactEmail'),array('contactEmail'=>$contactEmail));
	$user_count = $db->ud_getRowCountResult($result);
	
	if($user_count == 0)
	{
		$db->ud_insertQuery('ud_schools',array('schoolName'=>$schoolName,'city'=>$city,'countryID'=>$country,'contactName'=>$contactName,'contactEmail'=>$contactEmail,'contactNumber'=>$contactNumber,'contactPassword'=>md5($contactPassword)));
		header($thankyou);
	}
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
			<h2>Schools</h2>
		</div>
		<div class="row content">
			<div class="large-6 columns hide-for-small">
				<div style="padding: 20px;">
					<img src="../../resources/images/signup/left-div-school.jpg">
				</div>
			</div>
			<div class="large-6 columns">
				<p style="margin-top:20px;">Please fill in the form to complete your registration and join
					Ayuda as a school.Your registration will enable you to avail our
					volunteers ,add tasks and other services which Ayuda provides.We
					hope to help you soon...</p>
				<hr />
				<form id="form-school" action="../../modules/homepage/school.php" method="post">
					<div class="row">
						<div class="large-3 columns hide-for-small">
							<label for="name" class="inline right">School Name</label> 
							<label class="inline right">Contact Name</label> 
							<label class="inline right">Email</label> 
							<label class="inline right">Password</label> 
							<label class="inline right">Re- Enter</label> 
							<label class="inline right">Mobile</label> 
							<label class="inline right">City</label>
							<label class="inline right">Country</label>
						</div>
						<div class="small-12 large-8 columns">
							<input id="name" class="required" name="schoolName" type="text" placeholder="School Name" /> 
							<input id="contactperson" name="contactName" type="text" placeholder="Contact Person Name" /> 
							<input id="contactpersonEmail" name="contactEmail" type="text" placeholder="Contact Person Email" /> 
							<input id="password" class="required" name="contactPassword" type="password" placeholder="Password" /> 
							<input id="confpassword" class="required" name="confirm password" type="password" placeholder="Confirm Password" /> 
							<input id="mobile" name="contactNumber" type="text" placeholder="8148970027" />
							<input id="city" name="city" type="text" placeholder="Vellore" />
							<?php echo ud_general_country(); ?>
						</div>
						<div class="large-1 columns"></div>
					</div>
					<div class="secondary button right" style="margin-right: 43px;" id="signup">Sign Up</div>
				</form>
			</div>
		</div>
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
	
	<?php require '../../include/common/footer.php';?>
	<script src="../../resources/js/pages/school.js" type="text/javascript"></script>
</body>
</html>
