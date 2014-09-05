<?php
require '../../adminpanel/include/core.inc.php';
require '../../include/common/header_link.php';
	session_destroy();
	
	header('Location:'.$link_array['logo']);
	ob_get_clean();
?>