<?php 

	session_start();

	include_once '../config/database.php';

	include_once '../objects/account.php';	
	
	include_once '../util/functions.php';
	
	$data = json_decode(file_get_contents("php://input"));
		
	$user_email = sanitize($data->user_email);
	
	$directory = "../account/".$user_email. "/*.pdf";
	
	$files = glob($directory);
	
	$files_arr = array();
	
	$id = "";
	
	foreach($files as $file)
	{
		
		$form_action = "../account/".$user_email."/excel/".basename($file,".pdf").".xlsx";
		$file = basename($file);
		$file_id = basename($file,".pdf");
		$id = hash("md5",$user_email . $file_id);
		$row_arr = array(
				"id"=>$id,
				"file_name"=>$file,
				"user_email"=>$user_email,
				"form_action"=>$form_action
		);
	
		array_push($files_arr, $row_arr); 
	}
	
	
	echo json_encode($files_arr);
	
	
?>