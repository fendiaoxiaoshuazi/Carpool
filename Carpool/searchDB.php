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
	$dataJSON = json_decode($_GET['y'], false);
	
	$SearchS_Coordinate = "ST_GeomFromText('POINT(".$dataJSON->SearchS_Coordinate->lat." ".$dataJSON->SearchS_Coordinate->lng.")')";
	$SearchE_Coordinate = "ST_GeomFromText('POINT(".$dataJSON->SearchE_Coordinate->lat." ".$dataJSON->SearchE_Coordinate->lng.")')";
	
	$sql1 = "SET @buffurS = ST_Buffer(".$SearchS_Coordinate.", 1);";
	$sql2 = "SET @buffurE = ST_Buffer(".$SearchE_Coordinate.", 1);";
	$sql3 = "select D_Date, D_Time, S_Point, E_Point, Contact, Comment, ST_asText(S_Coordinate), ST_asText(E_Coordinate) from provider
	where ST_Contains(@buffurS, S_Coordinate) and ST_Contains(@buffurE, E_Coordinate);";
	
	$result="";
	
	
	
	if (mysqli_query($conn, $sql1)) {
		if (mysqli_query($conn, $sql2)) {
			if (mysqli_query($conn, $sql3)) {
				$output = (mysqli_query($conn, $sql3));
				$result = array();
				$result = $output->fetch_all(MYSQLI_ASSOC);
				//$result = json_encode($output);
			} else {
				$result = "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		} else {
			$result = "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	} else {
		$result = "Error: " . $sql . "<br>" . mysqli_error($conn);
	};

	
	
	//$dataJSON = $_REQUEST["x"];
	//$sql = "INSERT INTO provider (D_Date, D_Time, S_Point, E_Point, Contact, Comment, S_Coordinate, E_Coordinate) VALUES ('".$dataJSON->startDate."', '".$dataJSON->startTime."', '".$dataJSON->startAddress."', '".$dataJSON->endAddress."', '".$dataJSON->Contact."', '".$dataJSON->price."', ".$S_Coordinate.", ".$E_Coordinate.")"; 
	//$sql = "INSERT INTO provider (D_Date, D_Time, S_Point, E_Point, Contact, Comment) VALUES ('".$dataJSON->startDate."', '".$dataJSON->startTime."', '".$dataJSON->startAddress."', '".$dataJSON->endAddress."', '".$dataJSON->Contact."', '".$dataJSON->price."')"; 
	//$result;
	//if (mysqli_query($conn, $sql)) {
	//	$result = "New record created successfully";
	//} else {
	//	$result = "Error: " . $sql . "<br>" . mysqli_error($conn);
	//}

	//echo json_encode($data);
	//echo "".$sql."+".$result."";
	echo json_encode($result);
?>