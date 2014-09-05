<?php

require '../../adminpanel/include/dbhelper.inc.php';

$db = new dbHelper();
$db->ud_connectToDB();

// Slider
$result = $db->ud_whereQuery('ud_home_slider',NULL,array('visible'=>1));
$slider = $db->ud_mysql_fetch_assoc_all($result);

$photos = array();

for($i=0;$i<sizeof($slider);$i++)
{
	$photos[$i]=array("src"=>"../../resources/images/homepage/".$slider[$i]['sliderImage']);
}

echo json_encode($photos);
?>