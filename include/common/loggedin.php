<?php 

if(!isset($_SESSION['volunteerID']) && empty($_SESSION['volunteerID']))
{
	header('location:'.$link_array['logo']);
}

?>