<?php

	include_once '../config/database.php';
	include_once '../objects/account.php';
	
	// Retrieve the request's body and parse it as JSON
	$input = @file_get_contents("php://input");
	$event_json = json_decode($input,true);
	
	$data = $event_json['media_link_data'];
	$file_name = $event_json['file_name'];
	$remote_id = $event_json['remote_id'];

	$cmd = 'curl -O ' . $data;

	exec($cmd);
	
	$renamed_file = basename($file_name,".pdf").".xlsx";
	
	rename("data", $renamed_file);
	
	$user_email = check_document($remote_id);
	//$user_email = "email@email.com";
	
	$file_path = "../account/".$user_email . "/excel/".$renamed_file;
	
	
	copy($renamed_file,$file_path);
	
	unlink($renamed_file);
?>