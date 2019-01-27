	  var map;
      var infowindow;
	  var tuzla = {lat: 44.537950, lng: 18.673043};
	  var location_string = "List of Bingo shops near Tuzla [Latitude:"+tuzla["lat"]+" Lognitude:"+tuzla["lng"]+"]:";
	  var markers = new Array();
	 /* markers.push({"name": "Bingo Hiper", 
					  "address": "Address 123", 
					  "distance": "12.55", 
					  "longitude": "123.543543", 
					  "latitude": "125.573543" 
					});
	   */ 
      function initMap() {
        $("#table-header-text").text(location_string);
		
        map = new google.maps.Map($("#map")[0], {
          center: tuzla,
          zoom: 15
        });

        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
          location: tuzla,
          radius: 5,
          type: ['store']
        }, callback);
      }

      function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
          }
        }
      }

      function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });
		markers.push({"name": place.name, 
					  "address": place.formatted_address, 
					  "distance": distanceFromTuzla(place.geometry.location.lat(),place.geometry.location.lng()), 
					  "longitude": place.geometry.location.lng(), 
					  "latitude": place.geometry.location.lat() 
					});

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
      }
	  
	  //Function that will use ajax call to send a request to rest_service which should in turn save places in database 
	  function savePlaces(){
		  if(markers.length > 0){
			  $.ajax({
			   type: "POST",
			   url: "http://localhost/places/data/data_services/web_service.php",
			   dataType: "json",
			   contentType: 'application/json',
			   success: function(response) {
				   alert(JSON.parse(JSON.stringify(response))["message"]);
				},

			   data:JSON.stringify({ Markers: markers })
			  });
		  }
		  else{
			  alert("No loactions to save!");
		  }
		   
	  }
	  
	  //Stack overflow answer : https://stackoverflow.com/questions/27928/calculate-distance-between-two-latitude-longitude-points-haversine-formula
	  function distance(lat1, lon1, lat2, lon2) {
        var p = 0.017453292519943295;    // Math.PI / 180
        var c = Math.cos;
        var a = 0.5 - c((lat2 - lat1) * p)/2 + 
          c(lat1 * p) * c(lat2 * p) * 
          (1 - c((lon2 - lon1) * p))/2;

        return 12742 * Math.asin(Math.sqrt(a)); // 2 * R; R = 6371 km
      }
	  
	  //Calculate the distance from tuzla location
	  function distanceFromTuzla(lat,lon){
		  return distance(tuzla["lat"],tuzla["lng"],lat,lon);
	  }