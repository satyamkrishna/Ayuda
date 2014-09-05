<?php
	require '../../include/core.inc.php';
	require '../../include/loggedin.php';
	require '../../include/dbhelper.inc.php';	
	$db = new dbHelper();
	$db->ud_connectToDB();
	
	//FAQ
	
	$result = $db->ud_whereQuery('ud_faq',null,array('faqVisible'=>1),"AND",false,'ORDER BY faqNumber');
	$faq = $db->ud_mysql_fetch_assoc_all($result);

	
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
<?php require '../../include/datatable.php'; ?>
<link rel="stylesheet" href="../../resources/css/common-backend/backend.css" />
</head>
<body>

<?php require '../../include/header.php'; ?>
<div class="row content">
<div class="large-12 columns">
	<h4>Manage FAQs</h4>
	<div class="section-container tabs" data-section>
		<section class="section">
			<p class="title"><a href="#panel1">FAQs</a></p>
					<div class="content">
						<form>
							<div class="row" style="margin:20px 0px 20px 0px;">
								<div class="large-2 columns">
									<label class="right inline">Question</label>
								</div>
								<div class="large-10 columns">
									<input type="text"  id="question"/>
								</div>
							</div>
							<div class="row" style="margin:20px 0px 20px 0px;">
								<div class="large-2 columns">
									<label class="right inline">Answer</label>
								</div>
								<div class="large-10 columns">
									<textarea id="answer"></textarea>
								</div>
							</div>
							
							<div id="addFaq" class="button large-2 columns large-offset-2">Add FAQ</div>
						</form>
						
						<table class="faq">
								<thead>
									<tr>
										<th >#</th>
										<th >Question</th>	
										<th >Answer</th>	
										<th >Action</th>									
									</tr>
								</thead>
								<tbody>
									<?php
									for($i=0;$i<sizeof($faq);$i++)
									{
									?>
									<tr>
										<td style="width: 5%;"><?php echo $faq[$i]['faqNumber']; ?></td>
										<td><?php echo $faq[$i]['faqQuestion']; ?></td>	
										<td><?php echo $faq[$i]['faqAnswer']; ?></td>	
										<td style="width: 10%;"><div id="<?php echo $faq[$i]['faqID']; ?>"><input type="button" class="edit-button edit-faq"/><input type="button" class="delete-button delete-faq"/></div></td>									
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
<script src="../../resources/js/backend/faq.js"></script>
</body>

</html>
<![endif]-->