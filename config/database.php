<?php 

//Database object

//Open a connection

function db()
{
	
	$user = "statement_reader";
	$pass = "password";
	$db = "statement_reader_database";

	return new PDO("mysql:host=localhost;dbname=".$db,$user,$pass);
}

?>
