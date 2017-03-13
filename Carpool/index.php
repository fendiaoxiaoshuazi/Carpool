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
     height: 50px;
     float: left;
  }
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

<div id = "search_panel"> 
<form method="get">
	Search_Start:<input type="text" id="Search_Start" name="Search_Start" value="">
	Search_End:<input type="text" id="Search_End" name="Search_End" value="">
	<input type="button" id="Search_Search" name="Search_End" value="Search">
</form>
</div>

<div id="demo"> test information </div>

<div id="user_panel"> 

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

<div id="map_canvas">

</div>



<script type="text/javascript">    
   
function initMap() { 
	var geocoder = new google.maps.Geocoder();    
    var myOptions = {
		zoom : 15, 
		center: {lat: 43.472036, lng: -80.544847},
		mapTypeId : google.maps.MapTypeId.ROADMAP 
	}
	var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);

	console.log("first:addEventListener");
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
	
	var Search_Start, Search_End, SearchS_Coordinate, SearchE_Coordinate;
	var search_D = {
		Search_Start: Search_Start,
		Search_End: Search_End,
		SearchS_Coordinate: SearchS_Coordinate,
		SearchE_Coordinate: SearchE_Coordinate
	};
	console.log(data);
	console.log(search_D );
    //var dataString = JSON.stringify(data);
    //localStorage.setItem("data", dataString);
	document.getElementById("Submit").addEventListener('click', function() {
		SaveJson (data);
	});
	document.getElementById("Preview").addEventListener('click', function() {
		data.startDate = document.getElementById("D_Date").value;
		data.startTime = document.getElementById("D_Time").value;
		data.Contact = document.getElementById("Contact").value;
		data.price = document.getElementById("Comment").value;
		data.startAddress = document.getElementById("S_Point").value;
		data.endAddress = document.getElementById("E_Point").value;
		codeAddress_S(geocoder, map, data);
		codeAddress_E(geocoder, map, data);	
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
		getAddress_S(geocoder, map, search_D);
	});
	document.getElementById("Search_End").addEventListener('change', function() {
		search_D.Search_End = document.getElementById("Search_End").value;
		getAddress_E(geocoder, map, search_D);
	});
	document.getElementById("Search_Search").addEventListener('click', function() {
		SaveSearch(search_D);
	});
} 

function SaveJson (data) {
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
			document.getElementById("demo").innerHTML = "textcontent_fail";
		}
	}
	xmlhttp.open("GET", "connectDB.php?x=" + myJSON, true);
	//xmlhttp.setRequestHeader("Content-type","text/plain");
	xmlhttp.send();
}

function SaveSearch (search_D) {
	var myJSON, xmlhttp, myObj, x, txt = "";
	//console.log(localStorage.getItem("testJSON"));
	//myJSON = localStorage.getItem("testJSON")
	//localStorage.setItem("testJSON", myJSON);
	var myJSON = JSON.stringify(search_D);
	console.log(myJSON);
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
			//myObj = JSON.parse(this.responseText);
			//console.log(this.responseText);
			document.getElementById("demo").innerHTML = this.responseText;
		} else {
			document.getElementById("demo").innerHTML = "textcontent_fail";
		}
	}
	xmlhttp.open("GET", "searchDB.php?x=" + myJSON, true);
	//xmlhttp.setRequestHeader("Content-type","text/plain");
	xmlhttp.send();
}
    
function codeAddress_S(geocoder, resultmap, data) {
	console.log(data)
    //var dataString = JSON.stringify(data);
    //localStorage.setItem("data", dataString);
    geocoder.geocode({'address' : data.startAddress}, function(results, status) {
			if (status == 'OK') {
				console.log("enteryes");
				data.S_Coordinate = results[0].geometry.location;
				var marker = new google.maps.Marker({
					map : resultmap,
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
				infowindow.open(resultmap, marker);
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(resultmap, marker);
				});
				if (data.S_Coordinate && data.E_Coordinate) {
					var centerP = google.maps.geometry.spherical.interpolate(data.S_Coordinate, data.E_Coordinate, '1');
					console.log(centerP);
					resultmap.setCenter(centerP);
				}
				console.log("outyes");
            } else {
				console.log(status);
				alert("Geocode was not successful for the following reason: " + status);    
            }    
        }
    );  
}

function codeAddress_E(geocoder, resultmap, data) {
	console.log(data)
    //var dataString = JSON.stringify(data);
    //localStorage.setItem("data", dataString);
    geocoder.geocode({'address' : data.endAddress}, function(results, status) {
			if (status == 'OK') {
				console.log("enteryes");
				data.E_Coordinate = results[0].geometry.location;
				var marker = new google.maps.Marker({
					map : resultmap,
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
				infowindow.open(resultmap, marker);
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(resultmap, marker);
				});
				if (data.S_Coordinate && data.E_Coordinate) {
					var centerP = google.maps.geometry.spherical.interpolate(data.S_Coordinate, data.E_Coordinate, 0.5);
					console.log(centerP);
					resultmap.setCenter(centerP);
				}
				console.log("outyes");		
            } else {
				console.log(status);
				alert("Geocode was not successful for the following reason: " + status);    
            }    
        }
    );  
}

function getAddress_S(geocoder, resultmap, search_D) {
	console.log(search_D);
    //var dataString = JSON.stringify(data);
    //localStorage.setItem("data", dataString);
    geocoder.geocode({'address' : search_D.Search_Start}, function(results, status) {
			if (status == 'OK') {
				console.log("enteryes");
				search_D.SearchS_Coordinate = results[0].geometry.location;
				/*var marker = new google.maps.Marker({
					map : resultmap,
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
				infowindow.open(resultmap, marker);
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(resultmap, marker);
				});
				if (data.S_Coordinate && data.E_Coordinate) {
					var centerP = google.maps.geometry.spherical.interpolate(data.S_Coordinate, data.E_Coordinate, 0.5);
					console.log(centerP);
					resultmap.setCenter(centerP);
				}*/
				console.log("outyes");		
            } else {
				console.log(status);
				alert("Geocode was not successful for the following reason: " + status);    
            }    
        }
    );  
}

function getAddress_E(geocoder, resultmap, search_D) {
	console.log(search_D);
    //var dataString = JSON.stringify(data);
    //localStorage.setItem("data", dataString);
    geocoder.geocode({'address' : search_D.Search_End}, function(results, status) {
			if (status == 'OK') {
				console.log("enteryes");
				search_D.SearchE_Coordinate = results[0].geometry.location;
				/*var marker = new google.maps.Marker({
					map : resultmap,
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
				infowindow.open(resultmap, marker);
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(resultmap, marker);
				});
				if (data.S_Coordinate && data.E_Coordinate) {
					var centerP = google.maps.geometry.spherical.interpolate(data.S_Coordinate, data.E_Coordinate, 0.5);
					console.log(centerP);
					resultmap.setCenter(centerP);
				}*/
				console.log("outyes");		
            } else {
				console.log(status);
				alert("Geocode was not successful for the following reason: " + status);    
            }    
        }
    );  
}

</script>

</body>
</html>