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
     width: 95%;
     height: 75%;
     float: left;
	 margin-top: 0px;
	 margin-left: 2em;
  }
#demo {
    width: 100%;
    height: 170px;
    float: left;
	color: #FFFFFF;
	padding: 2em;
	background-color: #787878;
	
}
  .close {
    color: #E4B429;
    float: right;
    font-size: 35px;
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
    padding: 20px 200px;
    border: none;
    font-size: 16px;
	font-weight: 900;
    color: #E4B429;
    background: #000000;
    text-decoration: none;
    outline: none;
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
	letter-spacing:1px;
}
#Submit:hover{
	background-color: #FFD54F;
	color: #000000;
}

.title {
	position: relative;
	top: 0px;
	width: 100%;
	height: 200px;
	background-color:#DFDFDF;
}  
.formtitle {
	text-align: center;
	position: relative;
	top: 105px;
	left: 20px;
	color:black;
}

.formtitle h3{
    font-size: 3em;
    letter-spacing: 5px;
    text-transform: uppercase;
    font-weight: 900;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}


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
							<li><a class="page-scroll scroll" href="/carpool"><div class="combainicon"><span class="fa fa-car" style="text-align: center"><br>Home</div></a></li>
							<li><a class="page-scroll scroll" href="/carpool/provider.php"><div class="combainicon"><span class="fa fa-share-alt" style="text-align: center"><br>Provide</div></a></li>
							<li><a class="page-scroll scroll" href="/carpool/customer.php"><div class="combainicon"><span class="fa fa-search" style="text-align: center"><br>Seek</div></a></li>
						</ul>
					</div>
					<!-- /.navbar-collapse -->
				</div>
				<!-- /.container -->
				<div class="row">
					<div style="background-color:#FFFFAA; width:25%; float:left"><p><br></p></div>
					<div style="background-color:#FFEA3D; width:25%; float:left"><p><br></p></div>
					<div style="background-color:#FFD54F; width:25%; float:left"><p><br></p></div>
					<div style="background-color:#E4B429; width:25%; float:left"><p><br></p></div>
				</div>
			</nav>		
		</div>	
<!-- //header -->

<div class="row">
	<div class="title">
		<div class="formtitle">
			<h3>Carpool Provider Information</h3>
			<p>Please provide the information of you carpool information * required field</p>
		</div>
	</div>
</div>

<!-- modal -->
<div id="myModal" class="modal">
	<span class="close">&times;</span>
	<input type="button" id="Submit" name="submit" value="Submit">	
	<div id="map_canvas"></div>
	<div id="demo"> test information </div>
</div>
<!-- //modal --> 

<!-- form -->
<div class="contact" id="contact">
	<div class="contact-top">
		<form method="get" class="contact_form slideanim">
			<div class="message">
				<div class="leftdiv">
					<legend> STEP ONE </legend>
					D_Date: <span class="error">*</span>
					<input type="date" class="margin-right" id="D_Date" name="D_Date" placeholder="D_Date">
					
					D_Time: <span class="error">*</span>
					<input type="time" class="margin-right" id="D_Time" name="D_Time" placeholder="D_Time">
					
					Contact(email): <span class="error">*</span>
					<input type="text" class="margin-right" id="Contact" name="Contact" placeholder="Contact (email)">
					
					Price & Comment: <span class="error">*</span>
					<textarea id="Comment" name="Comment" rows="2" cols="30" placeholder="Price & Comment"></textarea>
				</div>
				<div class="rightdiv">
					<legend> STEP TWO </legend>
					<br><br>
					S_Point: <span class="error">*</span>
					<input type="text" id="S_Point" name="S_Point" placeholder="S_Point">
					<br><br><br>
					E_Point: <span class="error">*</span>
					<input type="text" id="E_Point" name="E_Point" placeholder="E_Point">
					
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
	<p>&copy; 2017 GEOG483 group. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a> & Jiateng</p>
</div>	
<!-- //footer -->

<script type="text/javascript" async defer> 


// model control
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("Preview");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
btn.onclick = function() {
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
<script src="/carpool/js/jquery-2.2.3.min.js"></script> 
<script src="js/bootstrap.js"></script>
</body>
</html>