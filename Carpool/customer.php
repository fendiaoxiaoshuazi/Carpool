<!DOCTYPE html>
<html>
<head>

<title>Carpool</title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
<meta name="viewport" content="width=device-width, initial-scale=1">   

<script src="/carpool/script.php" async defer></script>
<script src="/carpool/library/markerclusterer/src/markerclusterer.js"></script> 
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
#map_canvas {
     width: 93%;
     height: 92%;
     float: left;
	 margin-top: 3em;
	 margin-left: 2em;
  }
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
  td, th {
    border: 1px solid;
    text-align: left;
    padding: 8px;
  }
  th {
	 background-color: #FFD54F;
	 color: #000000;
  }
  tr:nth-child(even) {
    background-color: #DFDFDF;
  }
  tr:nth-child(odd) {
    background-color: #FFFFFF;
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
  
.search_panel {
	position: relative;
	left: 20px;
	top: 100px;
	width: 98%;
	height: 50px;
	float: left;
	margin: 10px;
}

.search_panel form{
	color: #FFFFFF;
	font-weight: 900;
}

.search_panel input[type="text"]{
	width: 36%;
    border-radius: 0;
    line-height: 22px;
    font-size: 14px;
    padding: 14px 17px 14px;
    outline: none;
    color: #000000;
    height: 50px;
    border: 1px solid #424141;
    margin: 0 0 20px;
    background: #FFFFFF;
	letter-spacing:1px;	
}

.search_panel input[type="button"]{
    padding: 1em 2em;
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

.search_panel input[type="button"]:hover  {
	background-color: #FFD54F;
	color: #000000;
}

form.search_panel {
    text-align: center;
    margin-top: 45px;
}

.Smap_container {
	position: relative;
	top: 0px;
	width: 98%;
	height: 500px;
	float: left;
	margin: 10px;
}

#map_details1 {
    width: 49%;
    height: 100%;
    float: left;
	margin: 5px;
}

#map_details2 {
    width: 49%;
    height: 100%;
    float: right;
	margin: 5px;
}
#demo {
	background-color: #DFDFDF;
	position: relative;
	top: 5px;
	overflow: auto;
    width: 100%;
    height: 400px;
    float: left;
}
.copy-right {
	position: relative;
	top: 10px;
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

.title {
	position: relative;
	top: 0px;
	width: 100%;
	height: 200px;
	background-color:#A2A2A2;
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
		<div id = "search_panel" class = "search_panel"> 
			<form method="get">
				Search_Start:<input type="text" id="Search_Start" name="Search_Start" value=""><span>   </span>
				Search_End:<input type="text" id="Search_End" name="Search_End" value="">
				<input type="button" id="Search_Search" name="Search_End" value="Search">
			</form>
		</div>
	</div>
</div>

<!-- modal -->
<div id="myModal" class="modal">	
	<div id="map_canvas"></div>
	<span class="close">&times;</span>
</div>
<!-- //modal --> 



<div class = "Smap_container">
	<div id="map_details1"></div>
	<div id="map_details2"></div>
</div>

<div id="demo"> Results </div>


<div class="clearfix"></div>
<!-- footer -->
<div class="copy-right">
	<p>&copy; 2017 GEOG483 group. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a> & Jiateng</p>
</div>	
<!-- //footer -->
<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="color:#E4B429; opacity: 1;"> </span></a>

<script type="text/javascript" async defer>

// model control
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("Search_Search");


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

var markers1 = [];
var markers2 = [];
var circle = [];
var map, Smap1, Smap2, geocoder, directionsService, directionsDisplay;
var markerCluster1, markerCluster2;
   
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
	markerCluster1 = new MarkerClusterer(Smap1, markers1, {
			imagePath: '/carpool/library/markerclusterer/images/m'
		});
	markerCluster2 = new MarkerClusterer(Smap2, markers2, {
			imagePath: '/carpool/library/markerclusterer/images/m'
		});

	
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
		deleteMarkers(Smap1, markers1);
		deleteMarkers(Smap2, markers2);
		deleteMarkers(map, circle);
		SaveSearch(search_D);
	}); 
}

</script>
<script src="/carpool/js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>