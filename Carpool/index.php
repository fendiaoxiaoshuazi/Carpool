<!DOCTYPE html>
<html>
<head>

<title>Carpool</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
<!--script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAN14SUZl9lZWNTaRnCIsP8lm1LxnaQRAo&callback=initMap"
    async defer ></script-->
<!--script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiHiLS6bxUWnytY2Nnr0ELahTxg6Kdpo8"></script-->  
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiHiLS6bxUWnytY2Nnr0ELahTxg6Kdpo8&callback=initMap&libraries=geometry"
    async defer></script>  
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
  <!--.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }-->
  <!--.row {
      padding: 5px;
  }-->
 </style>
  
<!--?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Carpool";

// Create connection to mySQL DB
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?-->

</head>

<body>

<button id="myBtn">Open Modal</button>

<div id = "search_panel"> 
<form method="get">
	Search_Start:<input type="text" id="Search_Start" name="Search_Start" value="">
	Search_End:<input type="text" id="Search_End" name="Search_End" value="">
	<input type="button" id="Search_Search" name="Search_End" value="Search">
</form>
</div>

<!--div id="myModal" class="modal"-->
<div id="user_panel"> 
<span class="close">&times;</span>

<p>
<!--?php
// define variables and set to empty values
$dateErr = $timeErr = $sPointErr = $ePointErr = $contactErr = "";
$D_Date = $D_Time = $S_Point = $E_Point = $Contact = $Comment = "";
$sql = "Not qualified";
$recorder = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["D_Date"])) {
    $dateErr = "D_Date is required";
  } else {
    $D_Date = test_input($_POST["D_Date"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9]{4}(-|\/)((0[1-9]|1[0-2])|[0-9])(-|\/)([0-9]|(0[1-9]|[1-2][0-9]|3[0-1]))$/",$D_Date)) {
      $dateErr = "Only Date allowed"; 
	  $recorder = false;
    }
  }
  
   if (empty($_POST["D_Time"])) {
    $timeErr = "D_Time is required";
  } else {
    $D_Time = test_input($_POST["D_Time"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/([0-1][0-9]|2[0-4]):[0-5][0-9](:[0-5][0-9]|)$/",$D_Time)) {
      $timeErr = "Only time allowed"; 
	  $recorder = false;
    }
  }
  
   if (empty($_POST["S_Point"])) {
    $sPointErr = "S_Point is required";
  } else {
    $S_Point = test_input($_POST["S_Point"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$S_Point)) {
      $sPointErr = "Only letters and white space allowed"; 
	  $recorder = false;
    }
  }
  
   if (empty($_POST["E_Point"])) {
    $ePointErr = "E_Point is required";
  } else {
    $E_Point = test_input($_POST["E_Point"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$E_Point)) {
      $ePointErr = "Only letters and white space allowed"; 
	  $recorder = false;
    }
  }
  
  if (empty($_POST["Contact"])) {
    $contactErr = "Contact is required";
  } else {
    $Contact = test_input($_POST["Contact"]);
    // check if e-mail address is well-formed
    if (!filter_var($Contact, FILTER_VALIDATE_EMAIL)) {
      $contactErr = "Invalid email format"; 
	  $recorder = false;
    }
  }

  if (empty($_POST["Comment"])) {
    $Comment = "";
  } else {
    $Comment = test_input($_POST["Comment"]);
  }
  
  if ($D_Date AND $D_Time AND $S_Point AND $E_Point AND $Contact AND $Comment AND $recorder) {
	//require 'connectDB.php';
	//echo $resultA;
	// echo $resutlB;
	//$sql = "INSERT INTO provider (D_Date, D_Time, S_Point, E_Point, Contact, Comment)
	//	VALUES ('".$D_Date."', '".$D_Time."', '".$S_Point."', '".$E_Point."', '".$Contact."', '".$Comment."')"; 
	//if (mysqli_query($conn, $sql)) {
	//	echo "New record created successfully";
	//} else {
	//	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	//}
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?-->
</p>

<h2>Carpool Provider Information</h2>
<h3>Please provide the information of you carpool information</h3>
<p><span class="error">* required field.</span></p>
<form method="get" <!--action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"-->
<fieldset>
<legend> STEP ONE </legend>
  D_Date: <input type="date" id="D_Date" name="D_Date" value="2017/3/11"<!--?php echo $D_Date;?-->
  <span class="error">* <!--?php echo $dateErr;?--></span>
  <br><br>
  D_Time: <input type="time" id="D_Time" name="D_Time" value="2:29"<!--?php echo $D_Time;?-->
  <span class="error">* <!--?php echo $timeErr;?--></span>
  <br><br>
  Contact(email): <input type="text" id="Contact" name="Contact" value="j293xu@uwaterloo.ca"<!--?php echo $Contact;?-->
  <span class="error">*<!--?php echo $contactErr;?--></span>
  <br><br>
  Price: <textarea id="Comment" name="Comment" rows="5" cols="40">90</textarea>
</fieldset>
<br><br>
<fieldset>
<legend> STEP TWO </legend>
  S_Point: <input type="text" id="S_Point" name="S_Point" value="Waterloo"<!--?php echo $S_Point;?-->
  <span class="error">*<!--?php echo $sPointErr;?--></span>
  <br><br>
  E_Point: <input type="text" id="E_Point" name="E_Point" value="Toronto"<!--?php echo $E_Point;?-->
  <span class="error">*<!--?php echo $ePointErr;?--></span>
  <br><br>
  <input type="button" id="Preview" name="preview" value="Preview">
</fieldset>
<br><br>
<input type="button" id="Submit" name="submit" value="Submit">
  <!--input type="button" id="Submit" name="submit" value="Submit"-->
</form>

<!--?php
echo "<h2>Your Input:</h2>";
echo $D_Date;
echo "<br>";
echo $D_Time;
echo "<br>";
echo $S_Point;
echo "<br>";
echo $E_Point;
echo "<br>";
echo $Contact;
echo "<br>";
echo $Comment;
echo "<br>";
echo $sql;
?-->

</div>
<!--/div-->

<div id="map_canvas">

</div>

<div id="demo"> test information </div>

<script type="text/javascript"> 

// model control
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

var markers = [];
var map, geocoder, directionsService, directionsDisplay;
// set useing objects
var startDate, startTime, startAddress, endAddress, Contact, price, S_Coordinate, E_Coordinate;
var data = {
		startDate: startDate,
		startTime: startTime,
		startAddress: startAddress,
		endAddress: endAddress,
		price: price,
		Contact: Contact,
		S_Coordinate: S_Coordinate,
		E_Coordinate: E_Coordinate,
};   
   
function initMap() { 
	var myOptions = {
		zoom : 15, 
		center: {lat: 43.472036, lng: -80.544847},
		mapTypeId : google.maps.MapTypeId.ROADMAP 
	}
	// add google map api
	geocoder = new google.maps.Geocoder();       
	map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
	
	directionsService = new google.maps.DirectionsService;
    directionsDisplay = new google.maps.DirectionsRenderer;
	directionsDisplay.setMap(map);


	/*var data = {
		startDate: startDate,
		startTime: startTime,
		startAddress: startAddress,
		endAddress: endAddress,
		price: price,
		Contact: Contact,
		S_Coordinate: S_Coordinate,
		E_Coordinate: E_Coordinate,
	};*/
	
	var Search_Start, Search_End, SearchS_Coordinate, SearchE_Coordinate;
	var search_D = {
		Search_Start: Search_Start,
		Search_End: Search_End,
		SearchS_Coordinate: SearchS_Coordinate,
		SearchE_Coordinate: SearchE_Coordinate
	};
	//console.log(data);
	//console.log(search_D );
    //var dataString = JSON.stringify(data);
    //localStorage.setItem("data", dataString);
	
	// add events listener
	document.getElementById("Submit").addEventListener('click', function() {
		SaveJson ();
	});
	document.getElementById("Preview").addEventListener('click', function() {
		deleteMarkers();
		data.startDate = document.getElementById("D_Date").value;
		data.startTime = document.getElementById("D_Time").value;
		data.Contact = document.getElementById("Contact").value;
		data.price = document.getElementById("Comment").value;
		data.startAddress = document.getElementById("S_Point").value;
		data.endAddress = document.getElementById("E_Point").value;
		codeAddress_S(function() {
			codeAddress_E();
        });
		//var myJSON = JSON.stringify(data);
		//localStorage.setItem("testJSON", myJSON);
	});
	//!!!!!remember to add following function to delete the marker. when one of the 
	//	following content changes, the markers should be deleted
	/*document.getElementById("S_Point").addEventListener('change', function() {
		data.startAddress = document.getElementById("S_Point").value;
		codeAddress_S(geocoder, map, data);
	});
	document.getElementById("E_Point").addEventListener('change', function() {
		data.endAddress = document.getElementById("E_Point").value;
		codeAddress_E(geocoder, map, data);
	});
	document.getElementById("D_Date").addEventListener('change', function() {
		data.startDate = document.getElementById("D_Date").value;
	});
	document.getElementById("D_Time").addEventListener('change', function() {
		data.startTime = document.getElementById("D_Time").value;
	});
	document.getElementById("Contact").addEventListener('change', function() {
		data.Contact = document.getElementById("Contact").value;
	});*/
	document.getElementById("Search_Start").addEventListener('change', function() {
		search_D.Search_Start = document.getElementById("Search_Start").value;
		getAddress_S(search_D);
	});
	document.getElementById("Search_End").addEventListener('change', function() {
		search_D.Search_End = document.getElementById("Search_End").value;
		getAddress_E(search_D);
	});
	document.getElementById("Search_Search").addEventListener('click', function() {
		deleteMarkers();
		SaveSearch(search_D);
	});
} 

// Sets the map on all markers in the array.
function setMapOnAll(map) {
	for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(map);
	}
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
    setMapOnAll(null);
}

// Shows any markers currently in the array.
function showMarkers() {
	setMapOnAll(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
    clearMarkers();
    markers = [];
}

// Set center and extent
function fsetcenter(Pa,Pb) {
	console.log(Pa);
	console.log(Pb);
	//set center
	var centerP = google.maps.geometry.spherical.interpolate(Pa, Pb, '0.5');
	map.setCenter(centerP);
	//set zoom
	var bounds = new google.maps.LatLngBounds();
	bounds.extend(Pa);
	bounds.extend(Pb);
	map.fitBounds(bounds);
}

// Find the route
function ffindroute(Pa, Pb) {
	directionsService.route({
          origin: Pa,
          destination: Pb,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
}
		
function SaveJson () {
	var myJSON, xmlhttp, myObj, x, txt = "";
	//console.log(localStorage.getItem("testJSON"));
	//myJSON = localStorage.getItem("testJSON")
	//localStorage.setItem("testJSON", myJSON);
	var myJSON = JSON.stringify(data);
	console.log(myJSON);
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
			//myObj = JSON.parse(this.responseText);
			//console.log(this.responseText);
			document.getElementById("demo").innerHTML = this.responseText;
		} else {
			document.getElementById("demo").innerHTML = "No matching record";
		}
	}
	xmlhttp.open("GET", "connectDB.php?x=" + myJSON, true);
	//xmlhttp.setRequestHeader("Content-type","text/plain");
	xmlhttp.send();
}

function SaveSearch (search_D) {
	var myJSON, xmlhttp, myObj, x = "";
	var txt = "<table stype='width:100%'><tr><th>Date</th><th>Time</th><th>Contact</th><th>Price</th></tr>";
	//console.log(localStorage.getItem("testJSON"));";
	//console.log(localStorage.getItem("testJSON"));
	//myJSON = localStorage.getItem("testJSON")
	//localStorage.setItem("testJSON", myJSON);
	var myJSON = JSON.stringify(search_D);
	//console.log(myJSON);
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
			myObj = JSON.parse(this.responseText);
			for (x in myObj) {
				txt += "<tr><td>"+myObj[x].D_Date+"</td><td>"+myObj[x].D_Time+"</td><td>"+myObj[x].Contact+"</td><td>"+myObj[x].Comment+"</td></tr>";
				//addmarker, addroute
			}	
			txt +="</table>";
			//console.log(txt);
			showing_result(myObj[x]);
			document.getElementById("demo").innerHTML = txt;
		} else {
			document.getElementById("demo").innerHTML = "textcontent_fail";
		}
	}
	xmlhttp.open("GET", "searchDB.php?y=" + myJSON, true);
	//xmlhttp.setRequestHeader("Content-type","text/plain");
	xmlhttp.send();
	//set center
	fsetcenter(search_D.SearchS_Coordinate,search_D.SearchE_Coordinate);
	//add buffer
	var cityCircle = new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            map: map,
            center: search_D.SearchS_Coordinate,
			radius: 5000,
	})
	var cityCircle = new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            map: map,
            center: search_D.SearchE_Coordinate,
			radius: 5000,
	})
}

//for adding     
function codeAddress_S(callback) {
	console.log(data)
    //var dataString = JSON.stringify(data);
    //localStorage.setItem("data", dataString);
    geocoder.geocode({'address' : data.startAddress}, function(results, status) {
			if (status == 'OK') {
				console.log("enteryes");
				data.S_Coordinate = results[0].geometry.location;
				var marker = new google.maps.Marker({
					map : map,
					position : (results[0].geometry.location),
					title : data.startAddress,
					//animation : google.maps.Animation.DROP 
				});    
                var display = "address: " + results[0].formatted_address;  
                var infowindow = new google.maps.InfoWindow({
					content : "<span style='font-size:11px'><b>Name: </b>"    
                                + data.startAddress + "<br>" + display + 
                      					"<br>" + 
                        "<b>Start Time:</b>" +  data.startTime + "<br>" +
                      "<b>Price:</b>" + data.price + "<br>" +                    
                      "</span>",
					pixelOffset : 0,
					position : results[0].geometry.location 
				});
				infowindow.open(map, marker);
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map, marker);
				});
				markers.push(marker);
				console.log("outyes");
            } else {
				console.log(status);
				alert("Geocode was not successful for the following reason: " + status);    
            }    
        }
    ); 
	callback();
}

function codeAddress_E() {
	console.log(data)
    //var dataString = JSON.stringify(data);
    //localStorage.setItem("data", dataString);
    geocoder.geocode({'address' : data.endAddress}, function(results, status) {
			if (status == 'OK') {
				console.log("enteryes");
				data.E_Coordinate = results[0].geometry.location;
				var marker = new google.maps.Marker({
					map : map,
					position : (results[0].geometry.location),
					title : data.endAddress,
					//animation : google.maps.Animation.DROP 
				});    
                var display = "address: " + results[0].formatted_address;  
                var infowindow = new google.maps.InfoWindow({
					content : "<span style='font-size:11px'><b>Name: </b>"    
                                + data.endAddress + "<br>" + display + 
                      					"<br>" + 
                        "<b>Start Time:</b>" +  data.startTime + "<br>" +
                      "<b>Price:</b>" + data.price + "<br>" +                    
                      "</span>",
					pixelOffset : 0,
					position : results[0].geometry.location 
				});
				infowindow.open(map, marker);
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map, marker);
				});
				markers.push(marker);
				//reset center
				if (data.S_Coordinate && data.E_Coordinate) {
					fsetcenter(data.S_Coordinate,data.E_Coordinate);
					ffindroute(data.S_Coordinate,data.E_Coordinate);
				}
				console.log("outyes");		
            } else {
				console.log(status);
				alert("Geocode was not successful for the following reason: " + status);    
            }    
        }
    );  
}

//for searching
function getAddress_S(search_D) {
	console.log(search_D);
    //var dataString = JSON.stringify(data);
    //localStorage.setItem("data", dataString);
    geocoder.geocode({'address' : search_D.Search_Start}, function(results, status) {
			if (status == 'OK') {
				console.log("enteryes");
				search_D.SearchS_Coordinate = results[0].geometry.location;
				/*var marker = new google.maps.Marker({
					map : map,
					position : (results[0].geometry.location),
					title : data.endAddress,
					//animation : google.maps.Animation.DROP 
				});    
                var display = "address: " + results[0].formatted_address;  
                var infowindow = new google.maps.InfoWindow({
					content : "<span style='font-size:11px'><b>Name: </b>"    
                                + data.endAddress + "<br>" + display + 
                      					"<br>" + 
                        "<b>Start Time:</b>" +  data.startTime + "<br>" +
                      "<b>Price:</b>" + data.price + "<br>" +                    
                      "</span>",
					pixelOffset : 0,
					position : results[0].geometry.location 
				});
				infowindow.open(map, marker);
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map, marker);
				});
				if (data.S_Coordinate && data.E_Coordinate) {
					var centerP = google.maps.geometry.spherical.interpolate(data.S_Coordinate, data.E_Coordinate, 0.5);
					console.log(centerP);
					resultmap.setCenter(centerP);
				}*/
				//markers.push(marker);
				console.log("outyes");		
            } else {
				console.log(status);
				alert("Geocode was not successful for the following reason: " + status);    
            }    
        }
    );  
}

function getAddress_E(search_D) {
	console.log(search_D);
    //var dataString = JSON.stringify(data);
    //localStorage.setItem("data", dataString);
    geocoder.geocode({'address' : search_D.Search_End}, function(results, status) {
			if (status == 'OK') {
				console.log("enteryes");
				search_D.SearchE_Coordinate = results[0].geometry.location;
				/*var marker = new google.maps.Marker({
					map : map,
					position : (results[0].geometry.location),
					title : data.endAddress,
					//animation : google.maps.Animation.DROP 
				});    
                var display = "address: " + results[0].formatted_address;  
                var infowindow = new google.maps.InfoWindow({
					content : "<span style='font-size:11px'><b>Name: </b>"    
                                + data.endAddress + "<br>" + display + 
                      					"<br>" + 
                        "<b>Start Time:</b>" +  data.startTime + "<br>" +
                      "<b>Price:</b>" + data.price + "<br>" +                    
                      "</span>",
					pixelOffset : 0,
					position : results[0].geometry.location 
				});
				infowindow.open(map, marker);
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map, marker);
				});
				if (data.S_Coordinate && data.E_Coordinate) {
					var centerP = google.maps.geometry.spherical.interpolate(data.S_Coordinate, data.E_Coordinate, 0.5);
					console.log(centerP);
					resultmap.setCenter(centerP);
				}*/
				//markers.push(marker);
				console.log("outyes");		
            } else {
				console.log(status);
				alert("Geocode was not successful for the following reason: " + status);    
            }    
        }
    );  
}


//for showing result
function showing_result(object) {
	console.log(object);
	var location_S = {lat:Number(object["x(S_Coordinate)"]), lng:Number(object["y(S_Coordinate)"])};
	var location_E = {lat:Number(object["x(E_Coordinate)"]), lng:Number(object["y(E_Coordinate)"])};
	console.log(location);
	var marker_S = new google.maps.Marker({
		map : map,
		position : (location_S),
		title : object.Comment,
		//animation : google.maps.Animation.DROP 
		}); 
	markers.push(marker_S);
	var marker_E = new google.maps.Marker({
		map : map,
		position : (location_E),
		title : object.Comment,
		//animation : google.maps.Animation.DROP 
		});
	markers.push(marker_E);
	/*var display = "address: " + results[0].formatted_address; 
	var infowindow = new google.maps.InfoWindow({
		content : "<span style='font-size:11px'><b>Name: </b>"
		+ data.startAddress + "<br>" + display + "<br>" + 
		"<b>Start Time:</b>" +  data.startTime + "<br>" +
		"<b>Price:</b>" + data.price + "<br>" + "</span>",
		pixelOffset : 0,
		position : results[0].geometry.location 
		});
		infowindow.open(map, marker);
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map, marker);
		}; */
	directionsService.route({
          origin: location_S,
          destination: location_E,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
}
</script>

</body>
</html>