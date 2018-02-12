<?php

	$cmd = 'curl -u 95c3f161fcc0dbf255fa335a4a6277667da54992 -F "url=http://statementreader.ca/uploads/SCOTIA_Test.pdf" https://api.docparser.com/v1/document/fetch/opkvawxivsnd';

	exec($cmd,$result);
	
	//var_dump($result);

	//$data = json_decode(file_get_contents("php://input"));
	
	/*$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	$txt = var_dump($result);
	fwrite($myfile, $txt);
	fclose($myfile);*/
	
	//var_dump($data->file_name);
	
	/*$cmd = "curl https://api.docparser.com/v1/results/opkvawxivsnd/c2a448e1c724e9af243de54be66cb243 -u 95c3f161fcc0dbf255fa335a4a6277667da54992";
	
	exec($cmd,$result);
	
	$decoded_array = json_decode($result[0]);
	$decoded_array = $decoded_array[0];
	
	//var_dump($decoded_array);
	
	$transactions = $decoded_array->transactions;
	
	$transaction_string = "";
	$i=0;
	$j=0;
	
	foreach($transactions as $t)
	{
		$i++;
		$i = $j;
		foreach($t as $item)
		{
				
			echo . $item . "<br/>";
			
		}
	}
	echo "<br/><br/>";*/
	
?>
