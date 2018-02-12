<?php 

	include_once '../config/database.php';

	include_once '../objects/account.php';	
	
	include_once '../util/functions.php';
	
	$data = json_decode(file_get_contents("php://input"));
		
	$content = sanitize($data->content);
	
	if(empty($content))
	{ 
		echo "We need some content to post to users.";
		return;
	}
	
	post_admin_content($content);
?>