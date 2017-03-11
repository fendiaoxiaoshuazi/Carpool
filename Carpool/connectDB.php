<?php
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
	//transfer JSON
	header("Content-Type: application/json; charset=UTF-8");
	$dataJSON = json_decode($_GET['x'], false);
	$S_Coordinate = "ST_GeomFromText('POINT(".$dataJSON->S_Coordinate->lat." ".$dataJSON->S_Coordinate->lng.")')";
	$E_Coordinate = "ST_GeomFromText('POINT(".$dataJSON->E_Coordinate->lat." ".$dataJSON->E_Coordinate->lng.")')";
	//$dataJSON = $_REQUEST["x"];
	$sql = "INSERT INTO provider (D_Date, D_Time, S_Point, E_Point, Contact, Comment, S_Coordinate, E_Coordinate) VALUES ('".$dataJSON->startDate."', '".$dataJSON->startTime."', '".$dataJSON->startAddress."', '".$dataJSON->endAddress."', '".$dataJSON->Contact."', '".$dataJSON->price."', ".$S_Coordinate.", ".$E_Coordinate.")"; 
	//$sql = "INSERT INTO provider (D_Date, D_Time, S_Point, E_Point, Contact, Comment) VALUES ('".$dataJSON->startDate."', '".$dataJSON->startTime."', '".$dataJSON->startAddress."', '".$dataJSON->endAddress."', '".$dataJSON->Contact."', '".$dataJSON->price."')"; 
	$result;
	if (mysqli_query($conn, $sql)) {
		$result = "New record created successfully";
	} else {
		$result = "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	//echo json_encode($data);
	echo "".$sql."+".$result."";
?>