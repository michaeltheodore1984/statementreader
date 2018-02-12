<?php 

	include_once '../config/database.php';

	include_once '../objects/account.php';	
	
	include_once '../util/functions.php';
	
	$data = json_decode(file_get_contents("php://input"));
		
	$user_email = sanitize($data->user_email);
	$file_name = sanitize($data->file_name);
	
	$directory = "../account/".$user_email. "/*.pdf";
	
	$files = glob($directory);
	
	$files_arr = array();
	
	foreach($files as $file)
	{
		
		$file = basename($file);
		$match = "/".$file_name."/i";
		
		if(!preg_match($match, $file))
			continue;
		
		$row_arr = array("file_name"=>$file);
		
		array_push($files_arr, $row_arr);
	}
	
	echo json_encode($files_arr);
		
?>