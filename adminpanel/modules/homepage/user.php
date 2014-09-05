<?php
	require '../../include/core.inc.php';
	require '../../include/loggedin.php';
	require '../../include/dbhelper.inc.php';	

	$db = new dbHelper;
	$db->ud_connectToDB();
	
	//User
	
	$result = $db->ud_whereQuery('ud_user');
	$user = $db->ud_mysql_fetch_assoc_all($result);
	
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
<title><?php echo $_SESSION['userLogin'] ?> - User</title>
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
	<h4>User Registration</h4>
	<div class="section-container tabs" data-section>
		<section class="section">
			<p class="title"><a href="#panel1">User - (<?php echo sizeof($user); ?>)</a></p>
					<div class="content">
					<?php 
					if($_SESSION['userLogin'] == 'satyamkrishna')
					{
					?>
					<button class="button secondary send-all">Step 1 : Create Certificate</button>
					<button class="button secondary send-all-mail">Step 2:Send Mail</button>
					<?php 
					}
					?>
						<table class="user">
								<thead>
									<tr>
										<th style="width: 70px; text-align: center;">#</th>
										<th style="width: 100px; text-align: center;">Code</th>	
										<th >Name</th>	
										<th style="width: 150px;">Email</th>
										<th >City</th>	
										<th >Certificate</th>
										<th>View Full Details</th>									
									</tr>
								</thead>
								<tbody>
									<?php
									for($i=0;$i<sizeof($user);$i++)
									{
										if($user[$i]['userCertificateStatus'] == 0)
										{
											$button = 'Send';
										}
										else
										{
											$button = 'Resend';
										}
									?>
									<tr id="<?php echo $user[$i]['userID'];?>">
										<td><?php echo ($i+1);?></td>
										<td><?php echo $user[$i]['userCode'];?></td>
										<td><?php echo getName($user[$i]['userName']);?></td>
										<td><?php echo $user[$i]['userEmail'];?></td>
										<td><?php echo getName($user[$i]['userCity']);?></td>
										<td><input type="button" class="button secondary send-certificate" value="<?php echo $button;?>"/></td>
								        <td><input type="button" class="button secondary" value="Get Full Details"/></td>	
									</tr>
									<?php
									}
									?>
								</tbody>
							</table>
					</div>
		</section>
	</div>
</div>		
</div>
<?php require '../../include/footer.php'; ?>
<script src="../../resources/js/backend/user.js"></script>
</body>

</html>
<![endif]-->