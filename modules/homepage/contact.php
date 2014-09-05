<?php 

require '../../adminpanel/include/dbhelper.inc.php';
require '../../adminpanel/include/core.inc.php';
require '../../adminpanel/include/help.inc.php';
require '../../include/common/header_link.php';
require '../../include/common/mailHelper.php';


$db = new dbHelper();
$db->ud_connectToDB();

if(isset($_POST['user'],$_POST['email'],$_POST['phone'],$_POST['desc']))
{
	if(!empty($_POST['user']) &&!empty($_POST['email']) &&!empty($_POST['phone']) &&!empty($_POST['desc']))
	{

		$user = htmlentities($_POST['user']);
		$email = htmlentities($_POST['email']);
		$phone = htmlentities($_POST['phone']);
		$desc = htmlentities($_POST['desc']);
	
		$subject = 'Contact Us';
		$body = "$desc <br><br> $user<br>$email<br>$phone";
		$s = new sendMail();
		
		
		$mailTo = 'rohit@ayuda-ngo.org';
		$s->sendMail('noreply@ayuda-ngo.org', $mailTo, $subject,$body);
		$mailTo = 'rahul@ayuda-ngo.org';
		$s->sendMail('noreply@ayuda-ngo.org', $mailTo, $subject,$body);
		$mailTo = 'satyamkrishna2004@gmail.com';
		$s->sendMail('noreply@ayuda-ngo.org', $mailTo, $subject,$body);
		
		
		header('location:'.$link_array['thankyoucontact']);
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


<body>
	<?php require '../../include/common/header-1.php'?>
	<?php require '../../include/common/header-2.php';?>
	<div class="content-wrapper">
		<div class="row page-title">
			<h2>How may we help You?</h2>
		</div>
		<div class="row content" style="padding:40px;">
			<div class="large-7 columns">
				<form action="../../modules/homepage/contact.php" method="post">
					<fieldset>
						<legend>Contact Us</legend>
						<p>Please fill in your Query.We will try to reach you as soon as
							possible</p>
						<div class="row">
							<div class="large-2 columns">
								<label class="right inline">Name</label> 
								<label
									class="right inline">Email</label> <label class="right inline">Phone
									No.</label>
							</div>
							<div class="large-10 columns">
								<input type="text" id="name" placeholder="e.g. Raj" name="user" /> <input
									type="text" id="email" placeholder="e.g. example@somemail.com" name="email"/>
								<input type="text" id="phone" placeholder="e.g. +918855446821" name="phone"/>
							</div>
						</div>
						<div class="row">
							<div class="large-2 columns">
								<label class="right inline">Description</label>
							</div>
						</div>
						<div class="row">
							<div class="large-12 columns">
								<textarea id="suggest" placeholder="e.g. The problem is... "
									rows="4" name="desc"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="large-2 columns"
								style="margin-top: 5px; margin-bottom: 20px;">
								<input type="submit" class="button" value="Contact" />
							</div>
						</div>

					</fieldset>
				</form>
			</div>
			<div class="large-5 columns" style="margin-top: 24px;">
				<div class="panel">
					<h5>Email</h5>
					<p>Queries : queries@ayuda-ngo.org</p>
				</div>
				<div class="panel">
					<h5>Address</h5>
					<iframe width="97%" frameborder="0" scrolling="no" marginheight="0"
						marginwidth="0"
						src="https://maps.google.co.in/maps?q=12.972871,79.159522&amp;num=1&amp;ie=UTF8&amp;t=m&amp;z=14&amp;ll=12.973017,79.159504&amp;output=embed"></iframe>
					<br /> <small><a
						href="https://maps.google.co.in/maps?q=12.972871,79.159522&amp;num=1&amp;ie=UTF8&amp;t=m&amp;z=14&amp;ll=12.973017,79.159504&amp;source=embed"
						style="color: #0000FF; text-align: left" target="_blank">View
							Larger Map</a> </small>
				</div>
			</div>
		</div>
	</div>
	<?php require '../../include/common/footer.php';?>
</body>
</html>