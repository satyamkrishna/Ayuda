<?php
	require '../../include/core.inc.php';
	require '../../include/loggedin.php';
	require '../../include/dbhelper.inc.php';	

	$db = new dbHelper();
	$db->ud_connectToDB();
	
	$result = $db->ud_getQuery('SELECT DISTINCT(city_state) as state_name FROM ud_general_city WHERE city_id IN (SELECT DISTINCT(userCityID) FROM ud_user WHERE userCityID IS NOT NULL)');
	$cities = $db->ud_mysql_fetch_assoc_all($result);
	$city_all = array('state_name' =>'All' );
	
	array_unshift($cities,$city_all);
	
	$city_id = 'all';
	
	if(isset($_GET['state']) && !empty($_GET['state']))
	{
		$city_id = strtolower($_GET['state']);
	}
	
	if($city_id == 'all')
	{	
		$result = $db->ud_whereQuery('ud_user');
		$user = $db->ud_mysql_fetch_assoc_all($result);
	}
	else
	{
		$result = $db->ud_getQuery('SELECT * FROM ud_user WHERE userCityID IN (SELECT city_id FROM ud_general_city WHERE city_state = \''.$city_id.'\')');
		$user = $db->ud_mysql_fetch_assoc_all($result);
	}
	
	$result = $db->ud_whereQuery('ud_team',array('userEmail'));
	$email = $db->ud_mysql_fetch_assoc_all($result);
	
	function getName($var)
	{
		return ucwords(strtolower($var));
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
<title><?php echo $_SESSION['userLogin'] ?> - Reports </title>
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
		<h4>State Wise Report</h4>	
		<div class="row">
			<div class="large-4 columns">
				<select style="height:43px;" id="city_select">
				<?php
				for($i=0;$i<sizeof($cities);$i++)
				{
					if(isset($_GET['state']) && !empty($_GET['state']))
					{
						if($cities[$i]['state_name'] == $_GET['state'])
						{
							echo '<option val="'.$cities[$i]['state_name'].'" selected="selected">'.$cities[$i]['state_name'].'</option>';
						}
						else 
						{
							echo '<option val="'.$cities[$i]['state_name'].'">'.$cities[$i]['state_name'].'</option>';	
						}
					}
					else 
					{
						echo '<option val="'.$cities[$i]['state_name'].'">'.$cities[$i]['state_name'].'</option>';	
					}
				}
				?>
				</select>
			</div>
			<div class="large-3 columns">
				<input id="get_report" type="button" class="button" value="Submit"/>
			</div>
			<div class="large-5 columns" id="email_div"> 
			<?php 
			if(isset($_GET['state']) && !empty($_GET['state']))
			{
			?>
			<div style="display:none" id="city_id">
			<?php echo $_GET['state']; ?>
			</div>
			<div style="display:none" id="func">
				state-wise
			</div>
			<div class="row">
				<div class="large-8 columns">
					<select style="height:43px;" id="email_select">
						<?php 
						foreach ($email as $data) 
						{
							echo '<option>'.$data['userEmail'].'</option>';	
						}
						?>
					</select>
				</div>
				<div class="large-4 columns">
					<input data-reveal-id="myModal" id="get_excel" type="button" class="button" value="Email"/>
				</div>
			</div>
			<?php
			}
			?>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<table class="user">
					<thead>
						<tr>
							<th style="width: 70px; text-align: center;">#</th>
							<th style="width: 100px; text-align: center;">Code</th>	
							<th>Name</th>	
							<th>Phone</th>
							<th style="width: 150px;">Email</th>
							<th>City</th>	
																
						</tr>
					</thead>
					<tbody>
						<?php
						if(isset($user))
						{
							for($i=0;$i<sizeof($user);$i++)
							{
						?>
						<tr id="<?php echo $user[$i]['userID'];?>">
							<td><?php echo ($i+1);?></td>
							<td><?php echo $user[$i]['userCode'];?></td>
							<td><?php echo getName($user[$i]['userName']);?></td>
							<td><?php echo $user[$i]['userMobile'];?></td>
							<td><?php echo $user[$i]['userEmail'];?></td>
							<td><?php echo getName($user[$i]['userCity']);?></td>
						</tr>
						<?php
							}
						}
						?>
					</tbody>
				</table>
			</div>
		</div>			
	</div>		
</div>
<div id="url" style="display:none;"><?php echo $_SERVER['PHP_SELF'].'?state='; ?></div>
<div id="myModal" class="reveal-modal small">
	<center>
		<img width="72px" height="72px" src="../../resources/images/common/loading.gif" alt="loading"/>  
	</center>
</div>
<?php require '../../include/footer.php'; ?>
<script src="../../resources/js/backend/manage_state_report.js"></script>
</body>

</html>
<![endif]-->