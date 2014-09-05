<?php 

require '../../adminpanel/include/dbhelper.inc.php';
require '../../adminpanel/include/core.inc.php';
require '../../include/common/header_link.php';

$db = new dbHelper();
$db->ud_connectToDB();

$result = $db->ud_getQuery('SELECT * FROM (SELECT * FROM `ud_event`
			 WHERE eventID in (SELECT distinct(eventID) from ud_event_photo))
			  e LEFT JOIN `ud_event_city` c ON e.eventCity = c.cityID ORDER BY  
			  `e`.`eventDate` DESC');
$event = $db->ud_mysql_fetch_assoc_all($result);

function createThumb($pathToImage, $pathToThumb, $thumbWidth ) 
{
    $info = pathinfo($pathToImage);
    if(file_exists($pathToThumb))
    {
    	return;
    }
	else if ( strtolower($info['extension']) == 'jpg' ) 
    {
      $img = imagecreatefromjpeg($pathToImage);
      $width = imagesx( $img );
      $height = imagesy( $img );
	 
	  $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image 
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagejpeg( $tmp_img,$pathToThumb);
	}
	else if ( strtolower($info['extension']) == 'png' ) 
    {
      $img = imagecreatefrompng($pathToImage);
      $width = imagesx( $img );
      $height = imagesy( $img );
	 
	  $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image 
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagepng( $tmp_img,$pathToThumb);
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
<script src="../../resources/js/foundation/foundation.clearing.js"></script> 
<link rel="stylesheet" href="../../resources/css/common/utopia.css" />
<link rel="stylesheet" href="../../resources/css/common/gallery.css" />
</head>
<body>
<?php require '../../include/common/header-1.php'?>
<?php require '../../include/common/header-2.php';?>
<div class="content-wrapper">
	<div class="row page-title">
		<h2>Gallery</h2>
	</div>
	<div class="row content" style="padding:20px 10px 10px 0px;">
		<div class="large-12 columns">
			<?php
			for($i=0;$i<sizeof($event);$i++)
			{
				echo '<div><p class="gallery-event-title">'.$event[$i]['eventTitle'].'</p>';
				$result = $db->ud_whereQuery('ud_event_photo',NULL,array('eventID'=>$event[$i]['eventID'],'photoVisible'=>1));
				$event_photos = $db->ud_mysql_fetch_assoc_all($result);
				?>
				<ul class="clearing-thumbs clearing-feature gallery" data-clearing>
					<?php
					for($j=0;$j<sizeof($event_photos);$j++)
					{
						$admin_event_folder = '../../adminpanel/upload/event/'.$event[$i]['city_name'].'/'.$event[$i]['eventID'].'/';
						$img_link = $admin_event_folder.$event_photos[$j]['photo'];
						$thumb_link = $admin_event_folder.'thumbnail_'.$event_photos[$j]['photo'];
						createThumb($img_link,$thumb_link,400);
						echo '<li><a href="'.$img_link.'"><img src="'.$thumb_link.'"></a></li>';	
					}
					?>
				</ul></div>
				<?php
			}
			?>
			
			<!--
				
  				<li class="clearing-featured-img"><a href="path/to/your/img"><img data-caption="caption here..." src="path/to/your/img-th"></a></li>
			
			-->
		</div>
	</div>
</div>
<?php require '../../include/common/footer.php';?>
</body>
</html>
