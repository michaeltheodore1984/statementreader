<?php 

	session_start();

	include_once '../config/database.php';

	include_once '../objects/account.php';	
	
	include_once '../util/functions.php';
	
	$data = json_decode(file_get_contents("php://input"));
		
	$user_email = sanitize($data->user_email);
	
	$dir_array = array("atb","bmo","cibc","cwb","rbc","scotiabank","td");
	
	$all_files = array();
	
	foreach($dir_array as $dir)
	{
		$directory = "../account/".$user_email. "/".$dir."/*.pdf";
		$files_to_add = glob($directory);
		$all_files += $files_to_add;
	}
	
	$files = $all_files;
	
	$files_arr = array();
	
	$id = "";
	
	foreach($files as $file)
	{
		
		$form_action = "http://statementreader.ca/account/".$user_email."/excel/".basename($file,".pdf").".xlsx";
		$file = basename($file);
		$file_id = basename($file,".pdf");
		$id = $user_email . $file_id;
		$row_arr = array(
				"id"=>$id,
				"file_name"=>$file,
				"user_email"=>$user_email,
				"form_action"=>$form_action
		);
	
		array_push($files_arr, $row_arr); 
	}
	
	
	echo json_encode($files_arr);
	
	return;
	
	foreach($files as $file)
	{
		
		$id = $_SESSION['user_email'] . $file;
		$form_id = hash("md5",$id);
		
		$form_action = "http://statementreader.ca/account/".$_SESSION['user_email']."/excel/".basename($file,".pdf").".xlsx";
		$item = "<div id='item_container'>".$file."<br/>";
		$item .= "<hr/>";
		$item .= "<span style='color:#555' class='fa fa-download'></span>";
		$item .= "<span onclick='download_excel(\"#".$form_id."\")' class='file_action'><form id='".$form_id."' style='display:none;' method='get' action='".$form_action."'></form>Download Excel File</span>";
		$item .= "<span style='color:#555' class='fa fa-trash-o'></span>";
		$item .= "<span ng-click='delete_file(\"".$_SESSION['user_email']."\",\"".$file."\")' class='file_action'>Delete ".$file."</span>";
		
		$item .= "</div>";
		
		echo $item;
	}
	
?>