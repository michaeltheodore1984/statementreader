<?php 

	session_start();

	include_once '../config/database.php';

	include_once '../objects/account.php';	
	
	include_once '../util/functions.php';
	
	$data = json_decode(file_get_contents("php://input"));
		
	$email = sanitize($data->login_email);
	$password = sanitize($data->login_password);
	
	
	if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
	{ 
		echo "Login with your email.";
		return;
	}
	
	if (empty($password))
	{
	 	echo "We need your password.";
		return;
	}
	

	$password = hash("sha256", $password);
			
	$row = login($email, $password);
	
	if(!$row)
		echo false;
	else
	{
		$_SESSION['user_email'] = $row['email'];
		$_SESSION['user_name'] = $row['full_name'];
		$_SESSION['company_name'] = $row['company_name'];
		
		$user_path = "../account/".$row['email']. "/excel";
		
		@mkdir($user_path, 0777, true);
		
		echo true;
	}	
		
?>