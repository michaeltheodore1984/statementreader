<?php 

	session_start();

	include_once '../config/database.php';

	include_once '../objects/account.php';	
	
	include_once '../util/functions.php';
	
	$data = json_decode(file_get_contents("php://input"));
		
	$email = sanitize($data->user_email);
	$password = sanitize($data->password);
	
	
	if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
	{ 
		echo "We need your email.";
		return;
	}
	
	if (empty($password))
	{
	 	echo "We need your password.";
		return;
	}

	$password = hash("sha256", $password);
			
	set_password($email, $password);
	
	
		
?>