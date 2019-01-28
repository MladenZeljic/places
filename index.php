<!DOCTYPE html>
<?php
	$api_key="AIzaSyBz53Xi9neMaBLRZ7EVkyY861VLfO9y-HQ";
?>
<html>
  <head>
    <title>Place Searches</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    
    <script src="/places/interface/scripts/js/places-map-script.js"></script> 
	
	<link rel="stylesheet" href="/places/interface/styles/table.css" />
	<link rel="stylesheet" href="/places/interface/styles/places-style.css">
  </head>
  <body>
	<div class="page">
		  	<div id="tabs" class="tabs"> <!-- Container for current page tabs -->
		      	<a id="tab1" href="javascript:void(0);" class="tab-selected" onclick="showSelectedView(this);">
		      		Map
		      	</a><!--

				--><a id="tab2" href="javascript:void(0);" onclick="showSelectedView(this);refreshTable();">
		      		Bingo Shop list
				</a>
		  	</div>
		  	<div id="views">
		  		<div id="tab1-view" class="tab-view">
					<div id="map"></div>
					<div class="save-btn">
						<button id="save" onclick="savePlaces()">Save</button>
					</div>
				</div>
				<div id="tab2-view" class="tab-view-hide">
					<div id="table-header-text" class="table-header-text"></div>
					<div class="datagrid">
						<table id="places-table">
							
						</table>
					</div>
				</div>
				
			</div>
	
	<script src="/places/interface/scripts/js/page-script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key;?>&libraries=places&callback=initMap" async defer></script>
	
  </body>
</html>
