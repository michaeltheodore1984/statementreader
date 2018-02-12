<?php

	session_start();
	
	session_destroy();
	
	unset($_SESSION['user_email']);
	unset($_SESSION['user_name']);
	unset($_SESSION['company_name']);

?>