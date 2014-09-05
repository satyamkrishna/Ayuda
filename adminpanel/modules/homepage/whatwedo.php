<?php
	require '../../include/core.inc.php';
	require '../../include/loggedin.php';
	require '../../include/dbhelper.inc.php';	
	$db = new dbHelper();
	$db->ud_connectToDB();

	//What We Do
	
	$result = $db->ud_whereQuery('ud_content',null,array('contentPage'=>'What We Do'));
	$whatwedo = $db->ud_mysql_fetch_assoc_all($result);
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
<title><?php echo $_SESSION['userLogin'] ?> - Template</title>
<!-- Metadata -->
<meta content="" name="description" />
<meta content="" name="keywords" />
<meta content="" name="author" />
<?php require '../../include/foundation.php'; ?>
<link rel="stylesheet" href="../../resources/css/common-backend/backend.css" />
</head>
<body>

<?php require '../../include/header.php'; ?>
<div class="row content">
<div class="large-12 columns">
	<h4>Manage What We Do</h4>
	<div class="section-container tabs" data-section>
		<section class="section">
			<p class="title"><a href="#panel1">What We Do</a></p>
					<div class="content row">
						<div class="large-2 columns">
							<label class="inline right">Content</label>
						</div>
						<div class="large-10 columns">
							<textarea class="whatwedo">
								<?php echo $whatwedo[0]['content']; ?>
							</textarea>
							<input type="button" value="update" id="update" class="button" />
						</div>
						
					</div>
					
		</section>
	</div>
</div>		
</div>
<?php require '../../include/footer.php'; ?>
<script src="../../resources/js/backend/whatwedo.js"></script>
</body>

</html>
<![endif]-->