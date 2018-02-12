<?php

	function sanitize($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = preg_replace("/\s+/"," ", $data);
		 
		return $data;
	}

?>