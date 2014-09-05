<?php 

require '../../adminpanel/include/dbhelper.inc.php';
require '../../adminpanel/include/core.inc.php';
require '../../include/common/header_link.php';

$db = new dbHelper();
$db->ud_connectToDB();

$contact_link = 'contact';

if($_SERVER['SERVER_ADDR'] == '127.0.0.1')
{
	$contact_link = 'contact.php';
}

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
			<h2>We'll be right back!</h2>
		</div>
		<div class="row content " style="padding:40px 20px 0px 20px;">
			<div class="large-12 columns">
				<p>We are launching our complete site anytime soon, and we will inform
					you of starting operations. Till then for any inquiry <a href="<?php echo $contact_link?>">contact us</a>
					from here and we will help you out.</p>
			</div>
		</div>
	</div>
	<?php require '../../include/common/footer.php';?>
</body>
</html>
