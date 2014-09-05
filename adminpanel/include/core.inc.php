<?php
    session_start();
    ob_start();
    $currentfile=$_SERVER['SCRIPT_NAME'];
    			
    function ud_user_loggedin()
    {
        if(isset($_SESSION['emailID']) && !empty($_SESSION['emailID']))
        {
            return true;
        }
        else return false;
    }
    
    function ud_admin_loggedin()
    {
    	if(isset($_SESSION['userID']) && !empty($_SESSION['userID']))
    	{
    		return true;
    	}
    	else return false;
    }
    
    function ud_volunteer_loggedin()
    {
    	if(isset($_SESSION['volunteerID']) && !empty($_SESSION['volunteerID']))
    	{
    		return true;
    	}
    	else return false;
    }
?>