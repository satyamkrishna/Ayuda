<?php 

if(!isset($_SESSION['schoolID']) && empty($_SESSION['schoolID']))
{
	header('location:'.$link_array['login']);
}

?>