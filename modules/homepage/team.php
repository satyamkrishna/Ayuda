<?php 

require '../../adminpanel/include/dbhelper.inc.php';
require '../../adminpanel/include/core.inc.php';
require '../../include/common/header_link.php';

$db = new dbHelper();
$db->ud_connectToDB();

// Team Founder
$result = $db->ud_whereQuery('ud_team',NULL,array('visible'=>1,'teamTitle'=>'Founder'),'AND',false,'ORDER BY number ASC');
$team_f = $db->ud_mysql_fetch_assoc_all($result);


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
		<h2>Our Team</h2>
	</div>
	<div class="row content"  style="padding:40px;">
		<h4>Our Founders</h4>
		<?php 
		for($i=0;$i<sizeof($team_f);$i++)
		{
		?>
		<div class="row">
			<div class="small-4 large-2 columns">
				<img width="100%" src="../../uploads/team/<?php echo $team_f[$i]['userLogo'];?>" />
			</div>
			<div class="small-8 large-10 columns">
				<p>
					<strong><?php echo $team_f[$i]['userName'];?></strong> 
				</p>
				<p style="text-align: justify;">
					<?php echo $team_f[$i]['userDetail'];?>
				</p>
			</div>
		</div>
		<hr>
		<?php 
		}
		?>
		
	</div>
</div>
<?php require '../../include/common/footer.php';?>
</body>
</html>
