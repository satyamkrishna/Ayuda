<?php
	if($_SERVER['SERVER_ADDR'] == '127.0.0.1')
	{
		header('Location:modules/homepage/index.php');
	}
	else
	{
		header('Location:home');	
	}
?>