<?php 
require '../../adminpanel/include/dbhelper.inc.php';
require '../../adminpanel/include/core.inc.php';
require '../../include/common/header_link.php';

$db = new dbHelper();
$db->ud_connectToDB();

// Slogans
$result = $db->ud_whereQuery('ud_slogans',NULL,array('visible'=>1));
$slogans = $db->ud_mysql_fetch_assoc_all($result);

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
<link rel="stylesheet" href="../../resources/css/frontend/slider.min.css" />
<script type="text/javascript" src="../../resources/js/vendor/slider.js"></script>
<?php require '../../include/common/map.inc.php';?>
</head>
<body>


<body onload="initialize()">
	<?php require '../../include/common/header-1.php'?>
	<?php require '../../include/common/header-2.php';?>
	<div class="content-wrapper home-back zero-padding-bottom">
		<div class="quote-div">
			<div class="row">
				<div class="large-12 columns quote-body">
					<ul id="quotations-slider" data-orbit>
						<?php 
						for($i=0;$i<sizeof($slogans);$i++)
						{
							?>
						<li class="quote-container">
							<p class="quote">
								<span>&lsquo;&lsquo;</span>
								<?php echo $slogans[$i]['sloganText'];?>
								<span>&rsquo;&rsquo;</span>
							</p> <span class="quote-by right"><?php echo $slogans[$i]['sloganBy'];?>
						</span>
						</li>
						<?php 
						}
						?>
					</ul>
				</div>
			</div>
		</div>
		<div class="home-back">
			<div class="row content home-content">
				<div id="slider" class="large-8 columns no-padding corner"></div>
				<div class="large-4 columns" style="padding-right: 0px;">
					<p id="map-title">Where We Work</p>
					<div id="map-canvas" style="width: 100%; height:400px;" />
				</div>
			</div>
		</div>
	</div>
	<?php require '../../include/common/footer.php';?>
	<script type="text/javascript" src="../../resources/js/pages/home.js"></script>
</body>
</html>
