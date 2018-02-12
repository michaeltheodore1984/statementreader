<?php

	include_once '../config/database.php';
	include_once '../objects/account.php';
	
	// Retrieve the request's body and parse it as JSON
	$input = @file_get_contents("php://input");
	$event_json = json_decode($input,true);
	
	var_dump($event_json);
	
	$remote_id = $event_json['remote_id'];
	
	if(empty($remote_id))
		return;
	
	$user_email = check_document($remote_id);
	
	if(empty($user_email))
		return;	
		
	/** Error reporting */
	error_reporting(E_ALL);
	
	/** Include path **/
	set_include_path('phpexcel/Classes');
	
	/** PHPExcel */
	include 'PHPExcel.php';
	
	/** PHPExcel_Writer_Excel2007 */
	include 'PHPExcel/Writer/Excel2007.php';
	
	// Create new PHPExcel object
	echo date('H:i:s') . " Create new PHPExcel object\n";
	$objPHPExcel = new PHPExcel();
	
	//var_dump($objPHPExcel);
	
	// Set properties
	echo date('H:i:s') . " Set properties\n";
	$objPHPExcel->getProperties()->setCreator($user_email);
	$objPHPExcel->getProperties()->setLastModifiedBy($user_email);
	$objPHPExcel->getProperties()->setTitle($user_email);
	$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Document");
	$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
	
	// Add some data
	echo date('H:i:s') . " Add some data\n";
	$objPHPExcel->setActiveSheetIndex(0);
	
	$spreadsheet_columns = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	
	$i = 0;
	$j = 0;
	
	foreach($event_json['transactions'] as $transaction)
	{
		$i++;
		foreach($transaction as $t)
		{	
			$cell = $spreadsheet_columns[$j] . $i;
			
			echo $cell;
			$objPHPExcel->getActiveSheet()->SetCellValue($cell, $t);
			$j++;
			if($j>4)
				$j = 0;
		}
	}
	
	
	// Save Excel 2007 file
	echo date('H:i:s') . " Write to Excel2007 format\n";
	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	
	$file_path = "../account/".$user_email . "/excel/".basename($event_json['file_name'],".pdf").".xlsx";	
	$objWriter->save($file_path);

?>