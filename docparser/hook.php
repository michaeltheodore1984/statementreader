<?php

	// Retrieve the request's body and parse it as JSON
	$input = @file_get_contents("php://input");
	$event_json = json_decode($input,true);
	
	/*$document_id = $event_json->{'document_id'};
	
	if(empty($document_id))
		return;*/
	
	foreach($event_json['transactions'] as $transaction)
	{
		foreach($transaction as $t)
		{
			
				echo " " . $t . " ";
		}
		echo "\n";
	}
	
	//var_dump($event_json['transactions']);
	
	
	
	//var_dump($event_json->{'transactions'}[0]);

	//var_dump($event_json->{'file_name'});

?>