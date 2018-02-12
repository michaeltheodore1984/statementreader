<?php 

	session_start();
	
	include_once '../util/functions.php';
	
	$data = json_decode(file_get_contents("php://input"));
		
	$user_email = sanitize($data->user_email);
	$file = sanitize($data->file);
	
	$path = "../account/".$user_email."/".$file;
	$excel_path = "../account/".$user_email . "/excel/".basename($file,".pdf").".xlsx";	
	
	unlink($path);
	unlink($excel_path);
		
?>