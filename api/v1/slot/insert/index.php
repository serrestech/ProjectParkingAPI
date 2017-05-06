<?php

	require_once("../../../../config.php");
	enableJSON();

	if(isset($_POST['carid']) && isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['city']) && isset($_POST['address'])) {

		$Carid = $_POST["carid"];
		$Latitude = $_POST['latitude'];
		$Longitude = ($_POST['longitude']);
		$City = ($_POST['city']);
		$Address = ($_POST['address']);

		$Query = "INSERT INTO slots(carid,latitude,longitude,city,address) VALUES ('$Carid','$latitude','$longitude','$city','$address')";

		$Result = mysql_query($Query);

		$ObjectJSON->Status = "OK";
		$ObjectJSON->Token = md5($Carid);
		$ObjectJSON->Message = "Succesfully inserted";	

	} else {
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Token = md5("BAD");
		$ObjectJSON->Message = "You must give carid, latitude, longitude, city and address using POST method";
		
	}

	printJSON($ObjectJSON);

?>