<?php 

require '../../adminpanel/include/dbhelper.inc.php';
require '../../adminpanel/include/core.inc.php';
require '../../include/common/header_link.php';
require '../../include/common/loggedin.php';

$db = new dbHelper();
$db->ud_connectToDB();

$final_task = array();
$result = $db->ud_getQuery('SELECT * FROM `ud_task` t JOIN `ud_admin_users` u ON t.taskBy = u.userID AND t.visible=1 ORDER BY t.tasktimestamp DESC');
$task1 = $db->ud_mysql_fetch_assoc_all($result);
$task2 = array();

$s1 = 0;
$s2 = 0;
$f1 = sizeof($task1);
$f2 = sizeof($task2);

$final_task = $task1;

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
<link rel="stylesheet" href="../../resources/css/common/task.css" />
</head>
<body>
	<?php require '../../include/common/header-1.php'?>
	<?php require '../../include/common/header-2.php';?>
	<div class="content-wrapper">
		<div class="row page-title">
			<h2>View All Task</h2>
		</div>
		<?php 
		for($i=0;$i<sizeof($final_task);$i++)
		{
		?>
			<div class="row content task-container">
			<div class="large-11 large-centered columns task">
				<p class="task-title"><?php echo $final_task[$i]['taskTitle'];?></p>
				<hr>
				<p class="task-org"><?php echo $final_task[$i]['taskOrg'];?><span class="task-place">, <?php echo $final_task[$i]['taskPlace'];?></span></p>
				<p class="task-by">By <?php echo $final_task[$i]['userName'];?> <span class="task-place">, <?php echo date('jS F Y',$final_task[$i]['tasktimestamp']); ?></span></p>
				<p class="task-desc"><?php echo $final_task[$i]['taskDesc'];?></p>
			</div>
			</div>
		<?php 
		}
		?>
		
	</div>
	<?php require '../../include/common/footer.php';?>
	<script type="text/javascript" src="../../resources/js/pages/viewtask.js"></script>
</body>
</html>