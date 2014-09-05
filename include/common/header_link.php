<?php 

$link_array = array('login'=>'/login','logo'=>'/','thankyou'=>'/thankyou','thankyous'=>'/thank-you','logout'=>'logout','contact'=>'/contact','thankyoucontact'=>'/suggestion','viewtask'=>'/viewtask');

if($_SERVER['SERVER_ADDR'] == '127.0.0.1')
{
	$link_array = array('login'=>'login.php','logo'=>'index.php','thankyou'=>'thankyou.php','thankyous'=>'thankyous.php','logout'=>'logout.php','contact'=>'contact.php','thankyoucontact'=>'thankyoucontact.php','viewtask'=>'viewtask.php');
}

?>