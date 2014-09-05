<?php 

require '../../adminpanel/include/dbhelper.inc.php';
require '../../adminpanel/include/core.inc.php';
require '../../include/common/header_link.php';

$db = new dbHelper();
$db->ud_connectToDB();

//FAQ

$result = $db->ud_whereQuery('ud_faq',null,array('faqVisible'=>1),"AND",false,'ORDER BY faqNumber');
$faq = $db->ud_mysql_fetch_assoc_all($result);

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
<link rel="stylesheet" href="../../resources/css/common/faq.css" />
</head>
<body>
<?php require '../../include/common/header-1.php'?>
<?php require '../../include/common/header-2.php';?>
<div class="content-wrapper">
	<div class="row page-title">
		<h2>FAQs</h2>
	</div>
	<div class="row content">
		<div class="large-11 large-centered columns faq">
			<?php for($i=0;$i<sizeof($faq);$i++)
			{ ?>
			<div class="question">
				<div class="row">
					<div class="large-1 small-1 columns question-no">
						<label ><?php echo $i+1; ?></label>
					</div>
					<div class="large-11 small-11 columns question-text" >
						<p ><?php echo $faq[$i]['faqQuestion']; ?></p>
					</div>
				</div>			
			</div>
			<div class="answer">
				<p><?php echo $faq[$i]['faqAnswer']; ?></p>
			</div>
			
			<?php } ?>
		</div>
	</div>
</div>
<?php require '../../include/common/footer.php';?>
</body>
</html>
