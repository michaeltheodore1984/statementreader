<?php 

//Database object

//Open a connection

function db()
{
	
	$user = "statement_reader";
	$pass = "HSJ.1234.hsm";
	$db = "statement_reader_database";

	return new PDO("mysql:host=localhost;dbname=".$db,$user,$pass);
}

?>