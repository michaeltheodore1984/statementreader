<?php

	// objects/account.php

    function createAccount($name, $company, $email, $password)
    {
    	$query = "insert into account set 
    		full_name = :full_name,
    		company_name = :company_name, 
    		email = :email,
		password = :password,
		created = now()";
		
    	$db = db();
    	$stmt = $db->prepare($query);
    	
  
    	$stmt->bindParam(":full_name", $name);
    	$stmt->bindParam(":company_name", $company);
    	$stmt->bindParam(":email", $email);
    	$stmt->bindParam(":password", $password);
    	
    	if($stmt->execute())
    	{	
    		$user_path = "../account/".$email. "/excel";
    		
    		mkdir($user_path, 0777, true);
    	
    		return true;
    	}
    	else
    		return false;
    	
    }
    
    function login($email,$password)
    {
	
    	$query = "select * from account where email='$email' and password='$password'";
    	
    	$db = db();
    	
    	// prepare query statement
    	$stmt = $db->prepare( $query );
    	
    	// close the database once finished
    	$db=null;
    
    	// execute query
    	$stmt->execute();
    	
    	// get retrieved row
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	 
    	// clear the statement once finished
    	$stmt = null;
    	
    	return $row; 
    }

    function register_document($user_email, $remote_id)
    {
    	$query = "insert into document set
    		user_email = :user_email,
    		remote_id = :remote_id,
   			created = now()";
    	
    	$db = db();
    	
    	$stmt = $db->prepare($query);
    	
    	$stmt->bindParam(":user_email", $user_email);
    	$stmt->bindParam(":remote_id", $remote_id);

    	$stmt->execute();
   
    }
    
    function check_document($remote_id)
    {
    	$query = "select * from document where remote_id = '$remote_id'";
    	
    	$db = db();
    	
    	// prepare query statement
    	$stmt = $db->prepare( $query );
    	
    	// close the database once finished
    	$db=null;
    	
    	// execute query
    	$stmt->execute();
    	
    	// get retrieved row
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	
    	$user_email = $row['user_email'];
    	
    	delete_document($row['user_email'],$remote_id);
    	
    	return $user_email;
    	
    }
    
    function delete_document($user_email, $remote_id)
    {
    	$query = "delete from document where user_email='$user_email' and remote_id = '$remote_id'";
    	
    	$db = db();
    	
    	// prepare query statement
    	$stmt = $db->prepare( $query );
    	
    	// close the database once finished
    	$db=null;
    	
    	// execute query
    	$stmt->execute();
    }
    
    function set_password($email,$password)
    {
    	
    	$query = "update account set password='$password' where email='$email'";
    	
    	$db = db();
    	
    	// prepare query statement
    	$stmt = $db->prepare( $query );
    	
    	// close the database once finished
    	$db=null;
    	
    	// execute query
    	$stmt->execute();
    	
    	// get retrieved row
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	
    	// clear the statement once finished
    	$stmt = null;
    	
    }
    
    function post_admin_content($content)
    {
    	
    	$query = "update description set
    		content = :content,
    		created = now()";
    	
    	$db = db();
    	$stmt = $db->prepare($query);
    	
    	$stmt->bindParam(":content", $content);
    	
    	if($stmt->execute())
    		return true;
    	else
    		return false;
    		
    }
    
    function get_admin_content()
    {
    	
    	$query = "select content from description";
    	
    	$db = db();
    	
    	// prepare query statement
    	$stmt = $db->prepare( $query );
    	
    	// close the database once finished
    	$db=null;
    	
    	// execute query
    	$stmt->execute();
    	
    	// get retrieved row
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	
    	// clear the statement once finished
    	$stmt = null;
    	
    	return html_entity_decode($row['content']);
    }
?>