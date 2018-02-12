<?php

 include_once'../config/database.php';
 include_once '../objects/account.php';
 include_once '../util/functions.php';

 $user_email = sanitize($_POST['user_email']);
 $parser_id = sanitize($_POST['parser_id']);
 
 $targetfolder = "../account/" . $user_email . "/";
 
 $file_name = basename( $_FILES['file']['name']);
 $file_name = str_replace(" ","_",$file_name);

 $targetfolder = $targetfolder . $file_name;

 $file_type = $_FILES['file']['type'];
 $file_size = $_FILES['file']['size'];
 $error = "";
 
 if(file_exists($targetfolder))
 	$error = "This file already exists.";
 
 if($file_size > 32000000)
 	$error = "This file is too big. Please upload a file up to 32 MB in size.";
 
 if ($file_type != "application/pdf")
 	$error = "This file is either corrupt or is not a PDF file."; 
 
 if(!empty($error))
 {
 ?>
 	<script>
 	window.onload = function()
 	{
 		window.parent.notifyParent("<?php echo $error; ?>");
 	}
 	</script>
 <?php 
 	return;
 }	

 if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))

 {
	
 	echo "The file ". $file_name. " is uploaded";
 	
 	$url = "http://statementreader.ca/account/".$user_email. "/" . $file_name;
 	
 	$unique = $user_email . $file_name;
 	
 	$remote_id = hash("md5",$unique);
 	
 	$url .= "&remote_id=".$remote_id;
 	
	$cmd = "curl -u 50789a44125e80764bc6fc9beaa42fb5f067a466 -d 'url=".$url."' https://api.docparser.com/v1/document/fetch/".$parser_id;
	
	exec($cmd);
	
	register_document($user_email,$remote_id);
 }

 else {

 	echo "Problem uploading file";

 }

?>
<script>
 	window.onload = function()
 	{
 		window.parent.notifyFileSize("<?php echo $file_size; ?>");
 	}
</script>