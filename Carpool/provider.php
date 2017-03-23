<!DOCTYPE html>
<html>
<head>

<title>Carpool</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiHiLS6bxUWnytY2Nnr0ELahTxg6Kdpo8&callback=initMap&libraries=geometry"
    async defer></script> 
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

</head>

<body>

<button id="myBtn">Open Modal</button>

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
	//console.log(data);
	
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
	});
} 

</script>

</body>
</html>