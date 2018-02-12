<?php 

	session_start();

	include_once '../config/database.php';

	include_once '../objects/account.php';	
	
	include_once '../util/functions.php';
	
	$data = json_decode(file_get_contents("php://input"));
		
	$name = sanitize($data->full_name);
	$company = sanitize($data->company_name);
	$email = sanitize($data->email);
	$password = sanitize($data->password);
	
	if(empty($name))
	{ 
		echo "This account needs your name.";
		return;
	}
	
	if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
	{
	 	echo "This account needs your email.";
		return;
	}
	
	if (empty($password))
	{
	 	echo "Please choose a secure password";
		return;
	}
	
	$name = ucwords($name);
	$company = ucwords($company);
	$password = hash("sha256", $password);
			
	if(createAccount($name, $company, $email, $password))
	{
		$_SESSION['user_email'] = $email;
		$_SESSION['user_name'] = $name;
		$_SESSION['company_name'] = $company;
		echo true;
	}
	else
		echo false;
?>