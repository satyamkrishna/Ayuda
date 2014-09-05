<?php 

require '../../adminpanel/include/dbhelper.inc.php';
require '../../adminpanel/include/core.inc.php';
require '../../include/common/header_link.php';

$db = new dbHelper();
$db->ud_connectToDB();

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
			<h2>Thank You!</h2>
		</div>
		<div class="row content " style="padding:40px 20px 0px 20px;">
			<div class="large-12 columns">
				<p>Thanks For your suggestions.We will certainly look into it.</p>
			</div>
		</div>
	</div>
	<?php require '../../include/common/footer.php';?>
</body>
</html>
