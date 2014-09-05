<?php
	require '../../include/core.inc.php';
	require '../../include/loggedin.php';
	require '../../include/help.inc.php';
	require '../../include/dbhelper.inc.php';	
	
	
	$db = new dbHelper;
	$db->ud_connectToDB();
	
	//User
	$result = $db->ud_whereQuery('ud_event_city');
	$city = $db->ud_mysql_fetch_assoc_all($result);
	
	
	$select = '<select name="event_city">';
	for($i=0;$i<sizeof($city);$i++) 
	{
		$select .= '<option value="'.$city[$i]['cityID'].'">'.$city[$i]['city_name'].'</option>';
	}
	$select .= '</select>';
	
	if(isset($_POST['event_name'],$_POST['event_city'],$_POST['event_desc']))
	{
		if(!empty($_POST['event_name']) &&!empty($_POST['event_city']))
		{
		
			$event_name = htmlentities($_POST['event_name']);
			$event_city = htmlentities($_POST['event_city']);
			$event_desc = htmlentities($_POST['event_desc']);
			$event_date = htmlentities($_POST['event_date']);
			
			$path = '../../upload/event/'.getCity($city,$event_city);
			
			if (!file_exists($path)) 
			{
				mkdir($path);
			}
			$db->ud_insertQuery('ud_event',array('eventTitle'=>$event_name,'eventDesc'=>$event_desc,'eventCity'=>$event_city,'eventDate'=>$event_date));
			$result = $db->ud_whereQuery('ud_event',NULL,array('eventTitle'=>$event_name,'eventDesc'=>$event_desc,'eventCity'=>$event_city,'eventDate'=>$event_date));
			$event = $db->ud_mysql_fetch_assoc($result);
			$new_path = $path.'/'.$event['eventID'];
			if (!file_exists($new_path)) 
			{
				mkdir($new_path);
			}
		}
	}
	
	$result = $db->ud_getQuery('SELECT * FROM (SELECT count(eventID) as count,eventID FROM
			 `ud_event_photo` GROUP BY eventID) x RIGHT JOIN `ud_event` e JOIN `ud_event_city`
			  c ON c.cityID = e.eventCity ON x.eventID = e.eventID');
	$event = $db->ud_mysql_fetch_assoc_all($result);
		
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
<title><?php echo $_SESSION['userLogin'] ?> - Gallery</title>
<!-- Metadata -->
<meta content="" name="description" />
<meta content="" name="keywords" />
<meta content="" name="author" />
<?php require '../../include/foundation.php'; ?>
<?php require '../../include/datatable.php'; ?>
</head>
<body>
<?php require '../../include/header.php'; ?>
<div class="row" style="padding-top:40px;">
	<h3>Add Event</h3>
	<form action="photos.php" method="post">
		<div class="large-2 columns hide-for-small">
			<label class="right inline">Event Name</label>
			<label class="right inline">Event City</label>
			<label class="right inline">Event Date</label>
			<label class="right inline">Event Desc</label>
		</div>
		<div class="large-4 columns">
			<input type="text" name="event_name" placeholder="Event Name"/>
			<?php echo $select;?>
		    <input type="date" name="event_date" placeholder="Event Date"/>
			<textarea name="event_desc" placeholder="Event Desc"></textarea>
		    <input type="submit" value="Submit"/>
		</div>
		<div class="large-6 columns">
		</div>
	</form>
</div>
<div class="row" style="margin-bottom:150px;">	
	<div class="large-12 columns"  style="padding-top:40px;">
		<table class="gallery">
			<thead>
				<tr>
					<th style="width: 70px;">#</th>
					<th>Event</th>
					<th style="width: 50px;">Photos Count</th>
					<th style="width: 100px;">City</th>
					<th style="width: 100px;">Add Photo</th>						
				</tr>
			</thead>
			<tbody>
				<?php
				for($i=0;$i<sizeof($event);$i++)
				{
					if($event[$i]['count'] == null)
					{
						$event[$i]['count'] = '-';
					}
				?>
				<tr>
					<td><?php echo $i+1; ?></td>
					<td><?php echo $event[$i]['eventTitle'];?></td>
					<td style="text-align:center;"><?php echo $event[$i]['count'];?></td>
					<td><?php echo $event[$i]['city_name'];?></td>
					<td><a class="button secondary small" href="addphoto.php?eventID=<?php echo $event[$i]['eventID'];?>">Add Photos</a></td>						
				</tr>
				<?php
				}
				?>
			</tbody>
		</table>	
	</div>			
</div>
<?php require '../../include/footer.php'; ?>
<script src="../../resources/js/backend/gallery.js"></script>
</body>

</html>
<![endif]-->