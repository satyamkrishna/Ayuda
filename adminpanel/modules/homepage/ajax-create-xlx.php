<?php

	require '../../include/core.inc.php';
	require '../../include/loggedin.php';
	require '../../include/dbhelper.inc.php';	

	$db = new dbHelper;
	$db->ud_connectToDB();
	
	//User
	
	$result = $db->ud_whereQuery('ud_user');
	$user = $db->ud_mysql_fetch_assoc_all($result);

	/** Error reporting */
	error_reporting(E_ALL);

	/** Include path **/
	ini_set('include_path', ini_get('include_path').';../../include/Classes/');
	
	/** PHPExcel */
	include 'PHPExcel.php';
	
	/** PHPExcel_Writer_Excel2007 */
	include 'PHPExcel/Writer/Excel2007.php';
	
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
	
	for($i=0;$i<sizeof($user);$i++)
	{
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.($i+2), $user[$i]['userCode']);
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.($i+2), $user[$i]['userName']);
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.($i+2), $user[$i]['userEmail']);
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.($i+2), $user[$i]['userMobile']);
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.($i+2), $user[$i]['userInstitute']);
		//$objPHPExcel->getActiveSheet()->SetCellValue('F'.($i+2), $user[$i]['']);
	}
		
	// Rename sheet
	$objPHPExcel->getActiveSheet()->setTitle('UserList');

	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	$objWriter->save(str_replace('ajax-create-xlx.php','../../upload/xls/banglore.xlsx', __FILE__));