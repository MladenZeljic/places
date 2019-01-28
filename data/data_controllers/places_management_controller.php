<?php
	require_once __DIR__.'/basic_controller.php';
	include_once __DIR__.'/../data_access/shopLocationsDAO.php';
	include_once __DIR__.'/../data_utils/util.php';
	
	//custom controller class for places.php page
	class places_management_controller extends basic_controller {
		
		//Activates when controller gets POST request
		public function do_post_action(){
			//Set header for response to text/html
			header('Content-Type: text/html; charset=utf-8');
			
			//Variable that will store response
			$response = "";
			
			//If we get refresh_all action, proceed (this will happen when user clicks on "Bingo Shop list" tab on the page)
			if(isset($_POST["action"])&&$_POST["action"]=='refresh_all'){
				//if(isset($_POST["max_records_per_page"])){
			
					//Maximum records per table page
					$max_records = $_POST["max_records_per_page"];

					//This variable holds the position of upper bound for place search 
					$from = 0;
					
					//We will get all places from database counting from $from position to $max_records position
					$places = (new shopLocationsDAO())->get_in_range($from,$max_records);
					
					//Now we will create the table string and echo it as a response
					$util = new Util();
					$response = $util->create_shop_location_table_string($places,1,$max_records,true);
				//}
			}
			echo $response;
		}

		public function do_get_action(){
			header('Content-Type: text/html; charset=utf-8');
			
			//Variable that will store response
			$response = "";
			
			if(isset($_GET["action"])&&$_GET["action"]=='get_page'){
				//if(isset($_POST["max_records_per_page"])&&isset($_POST["page"])){

					//Maximum records per table page
					$max_records = $_GET["max_records_per_page"];

					//Get the current page number
					$page_number = $_GET["page"];
					
					//Determine the position of upper bound for place search 
					$from = ($page_number*$max_records)-$max_records;
					
					//Get all places from database counting from $from position to $max_records position
					$places = (new shopLocationsDAO())->get_in_range($from,$max_records);
					
					//Create the table string and echo it as a response
					$util = new Util();
					
					$response = $util->create_shop_location_table_string($places,$page_number,$max_records,true);
				//}
			}
			
			echo $response;
			
		}
	}

?>
