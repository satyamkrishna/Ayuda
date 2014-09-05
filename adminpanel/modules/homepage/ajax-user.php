<?php
	require '../../include/core.inc.php';
	require '../../include/loggedin.php';
	require '../../include/dbhelper.inc.php';
	require '../../include/createCertificateImage.php';	
	require '../../../include/common/createCertificatePDF.php';
	require '../../../include/common/mailHelper.php';
	$db = new dbHelper();
	$db->ud_connectToDB();

	if(isset($_POST['func']) && !empty($_POST['func']))
	{
		switch ($_POST['func']) {
			case 'sendCert':
				$result = $db->ud_whereQuery('ud_user',NULL,array('userID'=>$_POST['userID']));
				$user = $db->ud_mysql_fetch_assoc($result);
				$file = '../../upload/certificate/'.$user['userCode'].'.jpg';
				$obj = new createImage();
				$obj->createCertificateImage(getName($user['userName']),$user['userCode'],$file,false);
				$obj = new createPDF();
				$obj->createCertificatePDF($file);
				break;
			case 'getUser':
				$result = $db->ud_whereQuery('ud_user',array('userID','userCertificateStatus'));
				$user = $db->ud_mysql_fetch_assoc_all($result);
				echo json_encode($user);
				break;
			
			case 'sendMail':
				
				$result = $db->ud_whereQuery('ud_user',NULL,array('userID'=>$_POST['userID']));
				$user = $db->ud_mysql_fetch_assoc($result);
				$db->ud_updateQuery('ud_user',array('userCertificateStatus'=>1),array('userID'=>$_POST['userID']));
				$file = '../../upload/certificate/'.$user['userCode'].'.pdf';
				$mailTo = $user['userEmail'];
				$subject = 'Registration Certificate From Ayuda';
				$body = 'Dear Volunteer,<br><br>We have attached your registration certificate in this mail.Thank you for your support.We look forward to work with you in the future.<br><br>Team Ayuda.';
				
				$s = new sendMail();
				$s->sendMail('noreply@ayuda-ngo.org', $mailTo, $subject,$body,true,array($file=>'application/pdf'));
				
				
				break;
			default:
				
				break;
		}
	}
	else {
		echo "Invalid";
	}
	
	function getName($var)
	{
		return ucwords(strtolower($var));
	}
?>