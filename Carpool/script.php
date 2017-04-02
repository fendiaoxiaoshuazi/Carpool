// Sets the map on all markers in the array.
function setMapOnAll(map, markers) {
	for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(map);
	}
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers(map, markers) {
	setMapOnAll(null, markers);
}

// Shows any markers currently in the array.
function showMarkers(map, markers) {
	setMapOnAll(map, markers);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers(map, markers) {
	clearMarkers(map, markers);
	markers.length = 0;
}

// Set center and extent
function fsetcenter(Pa, Pb, map) {
	//console.log(Pa);
	//console.log(Pb);
	//set center
	var centerP = google.maps.geometry.spherical.interpolate(Pa, Pb, '0.5');
	map.setCenter(centerP);
	//set zoom
	var bounds = new google.maps.LatLngBounds();
	bounds.extend(Pa);
	bounds.extend(Pb);
	map.fitBounds(bounds);
}

function fsmallcenter(Point, map) {
	//set center
	map.setCenter(Point);
	//set zoom
	map.setZoom(8);
}

// Find the route
function ffindroute(Pa, Pb) {
	directionsService.route({
		origin: Pa,
		destination: Pb,
		travelMode: 'DRIVING'
	}, function (response, status) {
		if (status === 'OK') {
			directionsDisplay.setDirections(response);
		} else {
			window.alert('Directions request failed due to ' + status);
		}
	});
}

// Add cluster
function addcluster() {
	console.log("enterAddcluster");
	markerCluster1.clearMarkers();
	markerCluster2.clearMarkers();
	markerCluster1.addMarkers(markers1);
	markerCluster2.addMarkers(markers2);
	console.log(markerCluster1.getMarkers());
	console.log(markerCluster2.getMarkers());
	console.log("exitAddcluster");

}

function SaveJson() {
	var myJSON,
	xmlhttp,
	myObj,
	x,
	txt = "";
	//console.log(localStorage.getItem("testJSON"));
	//myJSON = localStorage.getItem("testJSON")
	//localStorage.setItem("testJSON", myJSON);
	var myJSON = JSON.stringify(data);
	console.log(myJSON);
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
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

function SaveSearch(search_D) {
	var myJSON,
	xmlhttp,
	myObj,
	x = "", i = 1;
	var txt = "<table stype='width:100%'><tr><th>No</th><th>Date</th><th>Time</th><th>Start</th><th>End</th><th>Contact</th><th>Price</th></tr>";
	//console.log(localStorage.getItem("testJSON"));
	//myJSON = localStorage.getItem("testJSON")
	//localStorage.setItem("testJSON", myJSON);
	var myJSON = JSON.stringify(search_D);
	//console.log(myJSON);
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			myObj = JSON.parse(this.responseText);
			for (x in myObj) {
				txt += "<tr><td>" + i + "</td><td>" +myObj[x].D_Date + "</td><td>" + myObj[x].D_Time + "</td><td>" + myObj[x].S_Point + "</td><td>" + myObj[x].E_Point + "</td><td>" +myObj[x].Contact + "</td><td>" + myObj[x].Comment + "</td></tr>";
				//addmarker, addroute
				showing_result(myObj[x], i);
				i = i + 1;
			}
			txt += "</table>";
			//console.log(txt);
			document.getElementById("demo").innerHTML = txt;

			//add cluster
			//console.log(markers1.length);
			addcluster();
		} else {
			document.getElementById("demo").innerHTML = "textcontent_fail";
		}
	}
	xmlhttp.open("GET", "searchDB.php?y=" + myJSON, true);
	//xmlhttp.setRequestHeader("Content-type","text/plain");
	xmlhttp.send();

	//set center
	fsetcenter(search_D.SearchS_Coordinate, search_D.SearchE_Coordinate, map);
	fsmallcenter(search_D.SearchS_Coordinate, Smap1);
	fsmallcenter(search_D.SearchE_Coordinate, Smap2);
	//console.log(markers);

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
	circle.push(cityCircle);
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
	circle.push(cityCircle);

		//add route
		directionsService.route({
			origin: search_D.SearchS_Coordinate,
			destination: search_D.SearchE_Coordinate,
			travelMode: 'DRIVING'
		}, function (response, status) {
			if (status === 'OK') {
				directionsDisplay.setDirections(response);
			} else {
				window.alert('Directions request failed due to ' + status);
			}
		});

}

//for adding
function codeAddress_S(callback) {
	//console.log(data)
	//var dataString = JSON.stringify(data);
	//localStorage.setItem("data", dataString);
	geocoder.geocode({
		'address': data.startAddress
	}, function (results, status) {
		if (status == 'OK') {
			console.log("enteryes");
			//data.startAddress = results[0].formatted_address;
			data.S_Coordinate = results[0].geometry.location;

			/*
			var marker = new google.maps.Marker({
			map: map,
			position: (results[0].geometry.location),
			title: data.startAddress,
			//animation : google.maps.Animation.DROP
			});
			var display = "address: " + results[0].formatted_address;
			var infowindow = new google.maps.InfoWindow({
			content: "<span style='font-size:11px'><b>Name: </b>"
			+ data.startAddress + "<br>" + display +
			"<br>" +
			"<b>Start Time:</b>" + data.startTime + "<br>" +
			"<b>Price:</b>" + data.price + "<br>" +
			"</span>",
			pixelOffset: 0,
			position: results[0].geometry.location
			});
			infowindow.open(map, marker);
			google.maps.event.addListener(marker, 'click', function () {
			infowindow.open(map, marker);
			});
			markers.push(marker);
			 */

			console.log("outyes");
		} else {
			console.log(status);
			alert("Geocode was not successful for the following reason: " + status);
		}
	});
	callback();
}

function codeAddress_E(callback) {
	console.log(data)
	//var dataString = JSON.stringify(data);
	//localStorage.setItem("data", dataString);
	geocoder.geocode({
		'address': data.endAddress
	}, function (results, status) {
		if (status == 'OK') {
			console.log("enteryes");
			//data.endAddress = results[0].formatted_address;
			data.E_Coordinate = results[0].geometry.location;
			/*
			var marker = new google.maps.Marker({
			map: map,
			position: (results[0].geometry.location),
			title: data.endAddress,
			//animation : google.maps.Animation.DROP
			});
			var display = "address: " + results[0].formatted_address;
			var infowindow = new google.maps.InfoWindow({
			content: "<span style='font-size:11px'><b>Name: </b>"
			+ data.endAddress + "<br>" + display +
			"<br>" +
			"<b>Start Time:</b>" + data.startTime + "<br>" +
			"<b>Price:</b>" + data.price + "<br>" +
			"</span>",
			pixelOffset: 0,
			position: results[0].geometry.location
			});
			markers.push(marker);
			 */
			callback(data.S_Coordinate, data.E_Coordinate, map);
			console.log("outyes");
		} else {
			console.log(status);
			alert("Geocode was not successful for the following reason: " + status);
		}
	});
}

function FRouteScenter(pa, pb, map) {

	console.log("enter_FRouteScenter");

	// add route
	ffindroute(pa, pb);

	// reset center
	fsetcenter(pa, pb, map);

	// add info window
	var centerP = google.maps.geometry.spherical.interpolate(pa, pb, '0.5');
	var infowindow = new google.maps.InfoWindow({
			content: "<span style='font-size:11px'>" +
			"<b>Start Address: </b>" + data.startAddress + "<br>" +
			"<b>End Address: </b>" + data.endAddress + "<br>" +
			"<b>Start Date:</b>" + data.startDate + "<br>" +
			"<b>Start Time:</b>" + data.startTime + "<br>" +
			"<b>Price:</b>" + data.price + "<br>" +
			"</span>",
			pixelOffset: 0,
			position: centerP
		});
	infowindow.open(map);
	google.maps.event.addListener(map, 'click', function () {
		infowindow.open(map);
	});

	console.log("exit_FRouteScenter");

}

//for searching
function getAddress_S(search_D) {
	//console.log(search_D);
	//var dataString = JSON.stringify(data);
	//localStorage.setItem("data", dataString);
	geocoder.geocode({
		'address': search_D.Search_Start
	}, function (results, status) {
		if (status == 'OK') {
			//console.log("enteryes");
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
			//console.log("outyes");
		} else {
			//console.log(status);
			alert("Geocode was not successful for the following reason: " + status);
		}
	});
}

function getAddress_E(search_D) {
	//console.log(search_D);
	//var dataString = JSON.stringify(data);
	//localStorage.setItem("data", dataString);
	geocoder.geocode({
		'address': search_D.Search_End
	}, function (results, status) {
		if (status == 'OK') {
			//console.log("enteryes");
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
			//console.log("outyes");
		} else {
			//console.log(status);
			alert("Geocode was not successful for the following reason: " + status);
		}
	});
}

//for showing result
function showing_result(object, i) {
	//console.log(markers1);
	//console.log(markers1.length);
	//console.log(object);
	var location_S = {
		lat: Number(object["x(S_Coordinate)"]),
		lng: Number(object["y(S_Coordinate)"])
	};
	var location_E = {
		lat: Number(object["x(E_Coordinate)"]),
		lng: Number(object["y(E_Coordinate)"])
	};
	//console.log(location);
	var marker_S = new google.maps.Marker({
			label: ""+i+"",
			map: Smap1,
			position: (location_S),
			title: object.Comment,
			//animation : google.maps.Animation.DROP
		});
	markers1.push(marker_S);
	var marker_E = new google.maps.Marker({
			label: ""+i+"",
			map: Smap2,
			position: (location_E),
			title: object.Comment,
			//animation : google.maps.Animation.DROP
		});
	markers2.push(marker_E);
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

	/*
	directionsService.route({
	origin: location_S,
	destination: location_E,
	travelMode: 'DRIVING'
	}, function (response, status) {
	if (status === 'OK') {
	directionsDisplay.setDirections(response);
	} else {
	window.alert('Directions request failed due to ' + status);
	}
	});
	 */
}
