<?php

	require_once("../../../../config.php");
	enableJSON();

	if(isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['city']) && isset($_POST['address'])) {

		
		$Latitude = $_POST['latitude'];
		$Longitude = ($_POST['longitude']);
		$City = ($_POST['city']);
		$Address = ($_POST['address']);

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