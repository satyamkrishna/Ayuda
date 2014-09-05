<?php
	require '../../include/core.inc.php';
	require '../../include/loggedin.php';
	require '../../include/dbhelper.inc.php';	

	$db = new dbHelper();
	$db->ud_connectToDB();
	
	$result = $db->ud_whereQuery('ud_user',NULL,NULL,'AND',false,'where userCityID is NULL');
	$user = $db->ud_mysql_fetch_assoc_all($result);
	$count = count($user);
	
	$result = $db->ud_getQuery('SELECT x.userCity as city,count(x.userCity) as count , x.userCityID FROM ( SELECT * FROM `ud_user` WHERE userCityID IS NULL ) x GROUP BY x.userCity');
	$city = $db->ud_mysql_fetch_assoc_all($result);
	
	$result = $db->ud_whereQuery('ud_general_city');
	$cities = $db->ud_mysql_fetch_assoc_all($result);
	
	function get_cities($cities,$name)
	{
		$str = '<select id="select_city">';
			foreach ($cities as $city) 
			{
				if(strtolower($city['city_name']) == strtolower($name))
				{
					$str .= '<option  selected="selected" value="'.$city['city_id'].'">'.$city['city_name'].'('.$city['city_state'].')'.'</option>';	
				}
				else
				{
					{
					$str .= '<option value="'.$city['city_id'].'">'.$city['city_name'].'('.$city['city_state'].')'.'</option>';	
				}
				}
			}
		$str.= '</select>';
		return $str;
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
<title><?php echo $_SESSION['userLogin'] ?> - Manage Cities</title>
<!-- Metadata -->
<meta content="" name="description" />
<meta content="" name="keywords" />
<meta content="" name="author" />
<?php require '../../include/foundation.php'; ?>
<?php require '../../include/datatable.php'; ?>
</head>
<body>

<?php require '../../include/header.php'; ?>
<div class="row content">
<div class="large-12 columns">
	<br>
	<h4>Manage Your User Cities (<?php echo $count;?>)</h4>
	<table class="user">
		<thead>
			<tr>
				<th style="text-align:center;">#</th>
				<th style="text-align:center;">Distinct City</th>	
				<th style="text-align:center;">Count</th>
				<th>Select</th>	
				<th style="text-align:center;">Update</th>									
			</tr>
		</thead>
		<tbody>
			<?php 
			$i=1;
			foreach ($city as $data) 
			{
			?>
			<tr>
				<td><?php echo $i++; ?></td>
				<td class="city_name"><?php echo $data['city'];?></td>
				<td><?php echo $data['count'];?></td>
				<td><?php echo get_cities($cities,$data['city']); ?></td>
				<td><input type="button" class="button secondary update" value="Update"/></td>
			</tr>
			<?php	
			}
			?>
		</tbody>
	</table>				
</div>		
</div>
<?php require '../../include/footer.php'; ?>
<script src="../../resources/js/backend/manage_city.js"></script>
</body>

</html>
<![endif]-->