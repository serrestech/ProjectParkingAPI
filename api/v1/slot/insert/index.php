<?php

	require_once("../../../../config.php");
	enableJSON();

	if(isset($_GET['latitude']) && isset($_GET['longitude']) && isset($_GET['city']) && isset($_GET['address'])) {

		
		$Latitude = $_GET['latitude'];
		$Longitude = ($_GET['longitude']);
		$City = ($_GET['city']);
		$Address = ($_GET['address']);

		if(isAuthorized($Username,$Token)){

			$Query = "INSERT INTO slots(latitude,longitude,city,address) VALUES ('$Latitude','$Longitude','$City','$Address')";

			$Result = mysql_query($Query);

			$ObjectJSON->Status = "OK";
		
			$ObjectJSON->Message = "Succesfully inserted";	
		}

		else{
			echo "User is unauthorized";
		}

	} else {
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Message = "You must give , latitude, longitude, city and address using POST method";
		
	}

	printJSON($ObjectJSON);

?>