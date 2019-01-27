<?php
		include_once __DIR__.'/../data_access/shopLocationsDAO.php';
		
		//Get the data object that was sent through POST method and convert it to json array
		$data_object = json_decode(file_get_contents('php://input'),true);
		
		//Set header of the response
		header('Content-Type: application/json');
		//Create an array that will contain a message that will be returned back after the completion of processing of request 
		$message = array();
		
		//Create an instance of shopLocations data access object (we will use it for communication with database)
		$shopLocationsDao = new shopLocationsDAO();
		
		//Empty the table before we insert new records, as requested in assignment
		$shopLocationsDao->deleteAll();
		
		//Get the data array from JSON object
		$data_array = $data_object["Markers"];
		
		//Variable used for checking the insertion
		$saveOK = true;
		
		//foreach $data element in $data_array create shopLocation object, populate it with data and insert it in database
		foreach($data_array as $data) {
			$shopLocation = new shopLocation($data["name"], $data["address"], $data["distance"], $data["longitude"], $data["latitude"]);
			
			//If current insertion is successful, insert method will return true, else it will return false
			$saveOK&($shopLocationsDao->insert($shopLocation));
		}
		
		//If all insertions were successful, set the message to "All places are saved" else set the message to "Some or all places were not saved!"
		if($saveOK){
			$message["message"]="All places are saved";
		}
		else{
			$message["message"]="Some or all places were not saved!";
		}
		
		//Echo back response in json format
		echo json_encode($message);
?>