<!DOCTYPE html>
<html lang="en">
<head>

<title>Carpool</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">   

<script src="/carpool/script.php" async defer></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiHiLS6bxUWnytY2Nnr0ELahTxg6Kdpo8&callback=initMap&libraries=geometry" async defer></script> 

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="/carpool/css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
<link href="/carpool/css/popup-box.css" rel="stylesheet" type="text/css" media="all">
<link href="/carpool/css/style.css" type="text/css" rel="stylesheet" media="all"> 
<!--link href="css/main-gallery.css" rel="stylesheet"  type="text/css" media="screen" />  <!-- flexslider-CSS --> 
<link href="/carpool/css/font-awesome.css" rel="stylesheet">		<!-- font-awesome icons -->
<!-- //Custom Theme files --> 
	
<style>
.leftdiv {
	width: 45%;
	float: left;
	position: relative;
}
.rightdiv {
	width: 45%;
	float: right;
	position: relative;
}
  #user_panel {
     width: 100%;
     height: 100%;
     float: left;
  }
  #map_canvas {
     width: 80%;
     height: 90%;
     float: left;
  }
  #demo {
     width: 1200px;
     height: 200px;
     float: left;
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
.modal {
    display: hide; /*  none Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 10%;
    top: 10%;
    width: 80%; /* Full width */
    height: 80%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
#Submit{
    padding: 13px 30px;
    border: 2px solid #168eea;
    font-size: 16px;
    color: #fff;
    background: #168eea;
    text-decoration: none;
    outline: none;
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
	letter-spacing:1px;
}
  <!--.row {
      padding: 5px;
  }-->
</style>

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<!-- header -->
		<div class="header-w3layouts"> 
			<!-- Navigation -->
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container">
					<div class="navbar-header page-scroll">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">WatPool</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h1><a class="navbar-brand" href="index.html">WatPool</a></h1>
					</div> 
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav navbar-right">
							<!-- Hidden li included to remove active class from about link when scrolled up past about section -->
							<li class="hidden"><a class="page-scroll" href="#page-top"></a></li>
							<li><a class="page-scroll scroll" href="/carpool"><div id="combainicon">Home</div></a></li>
							<li><a class="page-scroll scroll" href="/carpool/provider.php"><div id="combainicon">Provide</div></a></li>
							<li><a class="page-scroll scroll" href="/carpool/customer.php"><div id="combainicon">Seek</div></a></li>
						</ul>
					</div>
					<!-- /.navbar-collapse -->
				</div>
				<!-- /.container -->
			</nav>  
		</div>	
		<!-- //header -->

<button id="myBtn">Open Modal</button>


<!-- modal -->
<div id="myModal" class="modal">	
	<div id="map_canvas"></div>
	<span class="close">&times;</span>
	<input type="button" id="Submit" name="submit" value="Submit">
	<div id="demo"> test information </div>
</div>
<!-- //modal --> 

<!-- form -->
<div class="contact" id="contact">
	<div class="contact-top">
		<h3 class="title-w3 con">Carpool Provider Information</h2>
		<p class="sub-text">Please provide the information of you carpool information</p>
		<p><span class="error">* required field.</span></p>
		<form method="get" class="contact_form slideanim">
			<div class="message">
				<div class="leftdiv">
					<legend> STEP ONE </legend>
					D_Date: <input type="date" class="margin-right" id="D_Date" name="D_Date" placeholder="D_Date">
					<span class="error">* <!--?php echo $dateErr;?--></span>
					D_Time: <input type="time" class="margin-right" id="D_Time" name="D_Time" placeholder="D_Time">
					<span class="error">* <!--?php echo $timeErr;?--></span>
					Contact(email): <input type="text" class="margin-right" id="Contact" name="Contact" placeholder="Contact (email)">
					<span class="error">*<!--?php echo $contactErr;?--></span>
					Price: <textarea id="Comment" name="Comment" rows="2" cols="30" placeholder="Price & Comment"></textarea>
				</div>
				<div class="rightdiv">
					<legend> STEP TWO </legend>
					S_Point: <input type="text" id="S_Point" name="S_Point" placeholder="S_Point">
					<span class="error">*<!--?php echo $sPointErr;?--></span>
					<br><br>
					E_Point: <input type="text" id="E_Point" name="E_Point" placeholder="E_Point">
					<span class="error">*<!--?php echo $ePointErr;?--></span>
				</div>
				<br><br>
			</div>
			<input type="button" id="Preview" name="preview" value="Preview">
			<br><br>
		</form>
	</div>
</div>
<!-- //from -->

<!-- footer -->
<div class="copy-right">
	<p>&copy; 2017 Dance Whirl. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
</div>	
<!-- //footer -->

<script type="text/javascript"> 


// model control
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("Preview");
var btn2 = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
	google.maps.event.trigger(map, "resize");
}
btn2.onclick = function() {
    modal.style.display = "block";
	google.maps.event.trigger(map, "resize");
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
			codeAddress_E(FRouteScenter);
		});
	});
} 

</script>

</body>
</html>