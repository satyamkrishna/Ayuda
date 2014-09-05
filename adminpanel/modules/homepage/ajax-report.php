<?php
	require '../../include/core.inc.php';
	require '../../include/loggedin.php';
	require '../../include/dbhelper.inc.php';
	require '../../include/Classes/PHPExcel.php';
	
	if($_SERVER['SERVER_ADDR']!='127.0.0.1')
	{
		require '../../../include/common/mailHelper.php';
	}
	$db = new dbHelper();
	$db->ud_connectToDB();

	if(isset($_POST['func']) && !empty($_POST['func']))
	{
		switch ($_POST['func']) 
		{
			case 'city-wise':
				if($_POST['city_id'] == 'all')
				{
					$result = $db->ud_whereQuery('ud_user');
					$user = $db->ud_mysql_fetch_assoc_all($result);
				}
				else
				{
					$result = $db->ud_whereQuery('ud_user',NULL,array('userCityID'=>$_POST['city_id']));
					$user = $db->ud_mysql_fetch_assoc_all($result);	
				}
				
				city_wise($user);
				if($_SERVER['SERVER_ADDR']!='127.0.0.1')
				{
					$file = '../../upload/xls/'.$_POST['name'].'.xlsx';
					$mailTo = $_POST['email'];
					$subject = 'User List for '.$_POST['name'];
					$body = 'Hereby is the attached file';
					
					$s = new sendMail();
					$s->sendMail('noreply@ayuda-ngo.org', $mailTo, $subject,$body,true,array($file=>'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'));
				}
				break;
			case 'state-wise':
				if($_POST['state'] == 'all')
				{
					$result = $db->ud_whereQuery('ud_user');
					$user = $db->ud_mysql_fetch_assoc_all($result);
				}
				else
				{
					$result = $db->ud_getQuery('SELECT * FROM ud_user WHERE userCityID IN (SELECT city_id FROM ud_general_city WHERE city_state = \''.$_POST['state'].'\')');
					$user = $db->ud_mysql_fetch_assoc_all($result);
				}
				
				state_wise($user);
				if($_SERVER['SERVER_ADDR']!='127.0.0.1')
				{
					$file = '../../upload/xls/'.$_POST['name'].'.xlsx';
					$mailTo = $_POST['email'];
					$subject = 'User List for '.$_POST['name'];
					$body = 'Hereby is the attached file';
					
					$s = new sendMail();
					$s->sendMail('noreply@ayuda-ngo.org', $mailTo, $subject,$body,true,array($file=>'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'));
				}
				break;
			default:
				
				break;
		}
	}
	else 
	{
		echo "Invalid";
	}
	
	function city_wise($data)
	{
		$db = new dbHelper;
		$db->ud_connectToDB();
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		// Set properties
		$objPHPExcel->getProperties()->setCreator("Satyam Krishna");
		$objPHPExcel->getProperties()->setLastModifiedBy("Ayuda NGO");
		$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
		
		
		// Add some data
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'User Code');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Phone');
		//$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Location');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'College');
		
		for($i=0;$i<sizeof($data);$i++)
		{
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.($i+2), $data[$i]['userCode']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.($i+2), $data[$i]['userName']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.($i+2), $data[$i]['userEmail']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.($i+2), $data[$i]['userMobile']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.($i+2), $data[$i]['userInstitute']);
			//$objPHPExcel->getActiveSheet()->SetCellValue('F'.($i+2), $user[$i]['']);
		}
			
		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('UserList');
	
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save(str_replace('ajax-report.php','../../upload/xls/'.$_POST['name'].'.xlsx', __FILE__));
	}
	
	function state_wise($data)
	{
		$db = new dbHelper;
		$db->ud_connectToDB();
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		// Set properties
		$objPHPExcel->getProperties()->setCreator("Satyam Krishna");
		$objPHPExcel->getProperties()->setLastModifiedBy("Ayuda NGO");
		$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
		
		
		// Add some data
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'User Code');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Phone');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Location');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'College');
		
		for($i=0;$i<sizeof($data);$i++)
		{
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.($i+2), $data[$i]['userCode']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.($i+2), $data[$i]['userName']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.($i+2), $data[$i]['userEmail']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.($i+2), $data[$i]['userMobile']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.($i+2), $data[$i]['userCity']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.($i+2), $data[$i]['userInstitute']);
		}
			
		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('UserList');
	
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save(str_replace('ajax-report.php','../../upload/xls/'.$_POST['name'].'.xlsx', __FILE__));
	}
?>