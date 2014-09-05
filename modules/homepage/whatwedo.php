<?php 

require '../../adminpanel/include/dbhelper.inc.php';
require '../../adminpanel/include/core.inc.php';
require '../../include/common/header_link.php';


$db = new dbHelper();
$db->ud_connectToDB();

//What We Do

$result = $db->ud_whereQuery('ud_content',null,array('contentPage'=>'What We Do'));
$whatwedo = $db->ud_mysql_fetch_assoc_all($result);

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
		<h2>What We Do</h2>
	</div>
	<div class="row content what-we">
		<div class="large-8 columns" style="text-align: justify;">
			<p><?php echo $whatwedo[0]['content']; ?></p>
		</div>
		<div class="large-4 columns what-we-do-img hide-for-small">
			<img src="<?php echo $whatwedo[0]['image']; ?>"/>
		</div>
	</div>
</div>
<?php require '../../include/common/footer.php';?>
</body>
</html>
