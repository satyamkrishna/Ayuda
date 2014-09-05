<?php
require '../../include/core.inc.php';
require '../../include/help.inc.php';
require '../../include/loggedin.php';
require '../../include/dbhelper.inc.php';	


$db = new dbHelper;
$db->ud_connectToDB();

//Event
$result = $db->ud_whereQuery('ud_event',NULL,array('eventID'=>$_GET['eventID']));
$event = $db->ud_mysql_fetch_assoc($result);


	
if(isset($_FILES['photo']['name']))
{
	//City
	$result = $db->ud_whereQuery('ud_event_city');
	$city = $db->ud_mysql_fetch_assoc_all($result);
	
	$temp = explode(".",$_FILES['photo']['name']);
	$ext = end($temp);	
	
	//if no errors...
	if(!$_FILES['photo']['error'])
	{
		$time = time();
		$file_name = $temp[0].'-'.time().'.'.$ext;
		$path = '../../upload/event/'.getCity($city,$event['eventCity']).'/'.$_GET['eventID'].'/'.$file_name;
		move_uploaded_file($_FILES['photo']['tmp_name'],$path);
		$db->ud_insertQuery('ud_event_photo',array('eventID'=>$_GET['eventID'],'photo'=>$file_name,'photoCaption'=>$_POST['photo_caption']));
	}
}

function getCity($city,$val)
{
	for($i=0;$i<sizeof($city);$i++) 
	{
		if($city[$i]['cityID'] == $val)
		{
			return $city[$i]['city_name'];
		}
	}
}

//Event_Photo
$result = $db->ud_whereQuery('ud_event_photo',NULL,array('eventID'=>$_GET['eventID']));
$event_photo = $db->ud_mysql_fetch_assoc_all($result);

function get_file_name($file)
{
	$temp = explode(".",$file);
	$ext = end($temp);	
	$file = substr($temp[0],0,strlen($temp[0])-11).'.'.$ext;
	return $file;
}

?>
<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en">

<![endif]--><!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en">

<![endif]--><!--[if IE 8]>
<html class="no-js lt-ie9" lang="en">

<![endif]--><!--[if gt IE 8]>
<!-->
<html class="no-js" lang="en">

<!--<![endif]-->
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Add Photo - <?php echo $event['eventTitle']; ?></title>
<!-- Metadata -->
<meta content="" name="description" />
<meta content="" name="keywords" />
<meta content="" name="author" />
<?php require '../../include/foundation.php'; ?>
<?php require '../../include/datatable.php'; ?>
</head>
<body>

<?php require '../../include/header.php'; ?>
<div class="row">
	<div class="large-12 columns" style="margin-top:30px;">
		<h5><?php echo $event['eventTitle']; ?></h5>
	</div>		
</div>
<div class="row">
	<div class="large-12 columns">
		<form action="addphoto.php?eventID=<?php echo $event['eventID'];?>" method="post" enctype="multipart/form-data">
		<input type="text" name="photo_caption" placeholder="Photo Caption" class="large-3"/>
		<input type="hidden" name="eventID" value="<?php echo $_GET['eventID']; ?>" /></br>
		<input type="file" name="photo" size="25" /></br>
		<input type="submit" name="submit" value="Submit" />
</form>
	</div>
</div>
<div class="row" style="margin-bottom:150px;">	
	<div class="large-12 columns"  style="padding-top:40px;">
		<table class="addphoto">
			<thead>
				<tr>
					<th style="width: 70px;">#</th>
					<th>File Name</th>
					<th>Photo Caption</th>
					<th>Visibile</th>						
					<th>Change</th>						
				</tr>
			</thead>
			<tbody>
				<?php
				for($i=0;$i<sizeof($event_photo);$i++)
				{
					if($event_photo[$i]['photoVisible'] == 1)
					{
						$event_photo[$i]['photoVisible'] = "Yes";		
					}
					else 
					{
						$event_photo[$i]['photoVisible'] = "No";		
					}
				?>
				<tr>
					<td><?php echo $i+1; ?></td>
					<td><?php echo get_file_name($event_photo[$i]['photo']); ?></td>
					<td><?php echo $event_photo[$i]['photoCaption']; ?></td>
					<td><?php echo $event_photo[$i]['photoVisible']; ?></td>
					<td></td>
				</tr>
				<?php
				}
				?>
			</tbody>
		</table>	
	</div>			
</div>
<?php require '../../include/footer.php'; ?>
<script src="../../resources/js/backend/addphoto.js"></script>
</body>
</html>