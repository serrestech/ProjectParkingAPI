<?php

	require_once("../../../../config.php");
	enableJSON();

	if(isset($_GET['latitude']) && isset($_GET['longitude']) && isset($_GET['city']) && isset($_GET['address'])) {

		
		$Latitude = $_GET['latitude'];
		$Longitude = ($_GET['longitude']);
		$City = ($_GET['city']);
		$Address = ($_GET['address']);

		$Query = "INSERT INTO slots(,latitude,longitude,city,address) VALUES ('$latitude','$longitude','$city','$address')";

		$Result = mysql_query($Query);

		$ObjectJSON->Status = "OK";
		$ObjectJSON->Token = md5($Carid);
		$ObjectJSON->Message = "Succesfully inserted";	

	} else {
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Token = md5("BAD");
		$ObjectJSON->Message = "You must give , latitude, longitude, city and address using POST method";
		
	}

	printJSON($ObjectJSON);

?>