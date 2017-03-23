<!DOCTYPE html>
<html>
<head>

<title>Carpool</title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiHiLS6bxUWnytY2Nnr0ELahTxg6Kdpo8&callback=initMap&libraries=geometry"
    async defer></script> 
<script src="/carpool/library/markerclusterer/src/markerclusterer.js"></script>
<script src="/carpool/script.php" async defer></script>
 	
<style>
  #user_panel {
     width: 500px;
     height: 800px;
     float: left;
  }
  #map_canvas {
     width: 700px;
     height: 800px;
     float: left;
  }
  #map_details1 {
     width: 350px;
     height: 400px;
     float: left;
  }
  #map_details2 {
     width: 350px;
     height: 400px;
     float: left;
  }
  #search_panel {
     width: 1200px;
     height: 50px;
     float: left;
  }
  #demo {
     width: 1200px;
     height: 200px;
     float: left;
  }
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }
  tr:nth-child(even) {
    background-color: #dddddd;
  }
  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
</style>
  
</head>

<body>

<div id = "search_panel"> 
<form method="get">
	Search_Start:<input type="text" id="Search_Start" name="Search_Start" value="">
	Search_End:<input type="text" id="Search_End" name="Search_End" value="">
	<input type="button" id="Search_Search" name="Search_End" value="Search">
</form>
</div>

<div id="map_canvas">
</div>
<div id="map_details1">
</div>
<div id="map_details2">
</div>

<div id="demo"> test information </div>

<script type="text/javascript">

var markers = [];
var markers1 = [];
var markers2 = [];
var map, Smap1, Smap2, geocoder, directionsService, directionsDisplay;
 
   
function initMap() { 
	var myOptions = {
		zoom : 15, 
		center: {lat: 43.472036, lng: -80.544847},
		mapTypeId : google.maps.MapTypeId.ROADMAP 
	}
	// add google map api
	geocoder = new google.maps.Geocoder();       
	map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
	Smap1 = new google.maps.Map(document.getElementById("map_details1"),myOptions);
	Smap2 = new google.maps.Map(document.getElementById("map_details2"),myOptions);

	
	directionsService = new google.maps.DirectionsService;
    directionsDisplay = new google.maps.DirectionsRenderer;
	directionsDisplay.setMap(map);
	
	var Search_Start, Search_End, SearchS_Coordinate, SearchE_Coordinate;
	var search_D = {
		Search_Start: Search_Start,
		Search_End: Search_End,
		SearchS_Coordinate: SearchS_Coordinate,
		SearchE_Coordinate: SearchE_Coordinate
	};
	//console.log(data);
	
	// add events listener
	document.getElementById("Search_Start").addEventListener('change', function() {
		search_D.Search_Start = document.getElementById("Search_Start").value;
		getAddress_S(search_D);
	});
	document.getElementById("Search_End").addEventListener('change', function() {
		search_D.Search_End = document.getElementById("Search_End").value;
		getAddress_E(search_D);
	});
	document.getElementById("Search_Search").addEventListener('click', function() {
		//deleteMarkers(map, markers);
		//deleteMarkers(Smap1, markers1);
		//deleteMarkers(Smap2, markers2);
		SaveSearch(search_D);
	});
} 

</script>
</body>
</html>