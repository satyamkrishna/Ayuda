<?php 

require '../../adminpanel/include/dbhelper.inc.php';
require '../../adminpanel/include/core.inc.php';
require '../../include/common/header_link.php';

$db = new dbHelper();
$db->ud_connectToDB();


#print_r($header);
#die();


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
			<h2>Thank You</h2>
		</div>
		<div class="row content">
			<div class="large-8 small-12 columns">
				<p style="margin-top: 40px;">
					A Letter From The President</br> </br> </br> Dear Volunteer,<br /></br>
					I congratulate you on your decision to join Ayuda, an organization
					that aims to help counts of underprivileged children and schools.
					The decision you managed to take today requires a lot of heart and
					strength and I'm glad you were able to hustle up the courage to do
					so. Millions of children across the country require our help and
					you can bring a smile in the face of a child, be it for a minute, I
					will consider your cause to join Ayuda fulfilled. </br> </br> You
					are now part of a network which spans across a nation, across
					religion, caste, color, social standing and hence I hope you
					understand and accept the responsibility that lies ahead. <br /> <br />All
					I ask of you is to further this cause and in return if the world or
					your country or the society around you does not give you anything,
					I promise you will always have my heart to take.<br /> <br />
					Cheers, <img alt="register"
						src="../../resources/images/register/signature.jpg" /> Rohit
					Ramesh.<br />FOUNDER AND PRESIDENT. <br /> <br />For Further
					Details please login the site with your provided username and
					password.
				</p>
			</div>
			<div class="large-4 columns hide-for-small thank-you">
				<img alt="register"
					src="../../resources/images/register/register.jpg" />
			</div>
		</div>
	</div>
	<?php require '../../include/common/footer.php';?>
</body>
</html>
