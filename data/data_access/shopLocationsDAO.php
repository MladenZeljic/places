<?php

	require_once __DIR__.'/../../data/data_connect/connection.php';
	require_once __DIR__.'/../../data/data_access/query_interface.php';
	require_once __DIR__.'/../../data/data_models/shopLocation.php';
	
	class shopLocationsDAO extends connection implements query_interface{
		
		//This method should return all records from table shoplocations
		public function get_all(){
			
			//Open the connection to database
			$connection = $this->get_connection();
			$shopLocations = array();

			//If the connection is opened
			if($connection != null){
				
				//Prepare query for execution
				$sql = "SELECT * FROM shoplocations";
				$statement = $connection->prepare($sql);
				
				//Execute query and get the result
				$statement->execute();
				$results = $statement->get_result();
				 
				//If we get any result back we will proceed 
				if ($results->num_rows > 0) {
					//Go through the results, create an object for each result, populate it with result data and the insert each result object into array
					while($row = $results->fetch_assoc()) {
						
						$shopLocation = new shopLocation($row["name"],$row["address"],$row["distance"],$row["longitude"],$row["latitude"]);
						$shopLocation->set_id($row["id"]);
						array_push($shopLocations,$shopLocation);
					}
				}
			}
			return $shopLocations;
		}
		
		//This method should return all records in a range bounded by upper and lower bound. It is useful for pagination
		public function get_in_range($from, $limit){
			
			//Open the connection to database
			$connection = $this->get_connection();
			$shopLocations = array();
			
			//If the connection is opened
			if($connection != null){
				
				//Prepare query for execution
				$sql = "SELECT * FROM shoplocations LIMIT ?,?";
				$statement = $connection->prepare($sql);
				
				//Bind the bounds to statement and execute te statement
				$statement->bind_param("ii", $from, $limit);
				$statement->execute();
				
				//Get the results of statement execution
				$results = $statement->get_result();
				
				//If we get any result back we will proceed 
				if ($results->num_rows > 0) {
					
					//Go through the results, create an object for each result, populate it with result data and the insert each result object into array
					while($row = $results->fetch_assoc()) {
						
						$shopLocation = new shopLocation($row["name"],$row["address"],$row["distance"],$row["longitude"],$row["latitude"]);
						$shopLocation->set_id($row["id"]);
						array_push($shopLocations,$shopLocation);
					}
				}
			}
			return $shopLocations;
		}
		
		//This method should return all records in a range bounded by upper and lower bound and filtered by parameter. It is useful for search pagination
		public function get_by_param_in_range($param ,$from, $limit){
			
			//Open the connection to database
			$connection = $this->get_connection();
			$shopLocations = array();
			
			//If the connection is opened
			if($connection != null){
				
				//Prepare query for execution
				$sql = "SELECT * FROM shoplocations WHERE name LIKE ? OR address LIKE ? LIMIT ?,?";
				$statement = $connection->prepare($sql);
				
				//Bind the bounds and param to statement and execute te statement
				$like = "%".$param."%";
				$statement->bind_param("ssii", $like, $like, $from, $limit);			
				$statement->execute();
				
				//Get the results of statement execution
				$results = $statement->get_result();
				 
				//If we get any result back we will proceed 
				if ($results->num_rows > 0) {
					
					//Go through the results, create an object for each result, populate it with result data and the insert each result object into array
					while($row = $results->fetch_assoc()) {
						
						$shopLocation = new shopLocation($row["name"],$row["address"],$row["distance"],$row["longitude"],$row["latitude"]);
						$shopLocation->set_id($row["id"]);
						array_push($shopLocations,$shopLocation);
					}
				}
			}
			return $shopLocations;
		}
		
		//This method should return the number of table rows, when they are filtered by parameter
		public function count_by_param($param){
			
			//Open the connection to database
			$connection = $this->get_connection();
			
			//If the connection is opened
			if($connection != null){
				
				//Prepare query for execution
				$sql = "SELECT COUNT(*) FROM shoplocations WHERE name LIKE ? OR address LIKE ? ";
				$statement = $connection->prepare($sql);
				$like = "%".$param."%";
				$statement->bind_param("ss", $like, $like);			
				
				//Execute the statement and get the result of execution
				$statement->execute();
				$count_result = $statement->get_result();
				
				//Return the result of COUNT
				$count_row = $count_result->fetch_assoc();
				return $count_row['COUNT(*)'];
			}
			return 0;
		}
		
		//This method should return the object representation of one row from database filtered by id
		public function get_by_id($id){

			//Open the connection to database
			$connection = $this->get_connection();
			
			//If the connection is opened
			if($connection != null){
				
				//Prepare query for execution
				$sql = "SELECT * FROM shoplocations WHERE id = ?";
				$statement = $connection->prepare($sql);
				
				//Bind parameters to statement
				$statement->bind_param("i",$id);
				
				//Execute the statement and get the result of execution
				$statement->execute();
				$result = $statement->get_result();
				 
				//In this case we should get only one result, because we search the table by id
				if ($result->num_rows == 1) {
					
					//Populate the object and return it
					$row = $result->fetch_assoc();
					$shopLocation = new shopLocation($row["name"],$row["address"],$row["distance"],$row["longitude"],$row["latitude"]);
					$shopLocation->set_id($row["id"]);
					return $shopLocation;
				}
			}
			return null;
			
		}
		
		//This method should perform insertion operation on shoplocations table
		public function insert($object){
			
			//First find the representation of object in database
			$db_object = $this->get_by_id($object->get_id());
			
			//If it doesn't exist
			if(!$db_object){
				
				//Open the connection to database
				$connection = $this->get_connection();
				
				//If the connection is opened
				if($connection != null){
					
					//Prepare query for execution
					$sql = "INSERT INTO shoplocations (name, address, distance, latitude, longitude)
						VALUES (?,?,?,?,?)";
					$statement = $connection->prepare($sql);
					
					//Bind parameters to statement
					$name = $object->get_name();
					$address = $object->get_address();
					$distance = $object->get_distance();
					$latitude = $object->get_latitude();
					$longitude = $object->get_longitude();
					
					$statement->bind_param("ssddd",$name,$address,$distance,$latitude,$longitude);
					
					//Insert objects representation in database and return the result of query execution
					return $statement->execute();
				}
			}
			return false;
			
		}

		//This method should perform update operation on shoplocations table		
		public function update($old_object, $new_object){
			
			//First find the representation of old object in database, since we want to update the old object
			$db_object = $this->get_by_id($old_object->get_id());

			//If it exists proceed			
			if($db_object){
				//Open the connection to database
				$connection = $this->get_connection();
				
				//If the connection is opened
				if($connection != null){
				
					//Prepare query for execution
					$sql = "UPDATE shoplocations SET name = ?, address = ?, distance = ?, latitude = ?, longitude = ? WHERE id = ?";
					$statement = $connection->prepare($sql);

					//Bind query parameters
					$name = $new_object->get_name();
					$address = $new_object->get_address();
					$distance = $new_object->get_distance();
					$latitude = $new_object->get_latitude();
					$longitude = $new_object->get_longitude();
					$id_address = $db_object->get_id();
					
					$statement->bind_param("ssdddi",$name,$address,$distance,$latitude,$longitude,$id_address);
													   
					//Update old objects representation in database and return the result of query execution
					return $statement->execute();
				}
			}
			return false;
			
		}
		
		//This method should perform delete operation (of one row) on shoplocations table
		public function delete($object){
			
			//First find the representation of object in database
			$db_object = $this->get_by_id($object->get_id());
			
			//If it exists proceed
			if($db_object){
				$connection = $this->get_connection();
				
				//If the connection is opened
				if($connection != null){
					
					//Prepare query for execution
					$sql = "DELETE FROM shoplocations WHERE id = ?";
					$statement = $connection->prepare($sql);
					
					//Bind object id to statement
					$id = $db_object->get_id();
					$statement->bind_param("i",$id);
					
					//Delete its representation in database and return the result of query execution
					return $statement->execute();
				}
			}
			return false;
			
		}
		
		//This method should perform delete operation on shoplocations table
		public function deleteAll(){
			
			//Open a connection to database
			$connection = $this->get_connection();
			
			//If connection is sucessfully opened proceed, else return false
			if($connection != null){
				
				//Delete everything from shoplocations table
				$sql = "DELETE FROM shoplocations";
				$statement = $connection->prepare($sql);
					
				return $statement->execute();
			}
			return false;
			
		}
	}
	
?>
