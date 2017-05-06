<?php
	
	require_once("../../../../config.php");
	enableJSON();

	if(isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['city']) && isset($_POST['address']) && isset($_POST['startlat']) && isset($_POST['startlng'])) {

		
		$Latitude = $_POST['latitude'];
		$Longitude = $_POST['longitude'];
		$City = $_POST['city'];
		$Address = $_POST['address'];
		$Startlat = $_POST['startlat'];
		$Startlng = $_POST['startlng'];

		//$pow1 = POW(69.1 * (latitude - [$Startlat]), 2);
		//$pow2 = POW(69.1 * ([$Startlng] - longitude) * COS(latitude / 57.3), 2)



		echo $pow1;


		$Query = "SELECT latitude, longitude,  SQRT(
						POW(69.1 * (latitude - $Startlat), 2)
    				 + 	POW(69.1 * ($Startlng - longitude) * COS(latitude / 57.3), 2)
    					) AS distance
					FROM slots HAVING distance < 25  ORDER BY distance";

		$Result = mysql_query($Query)  or die("Query didnt execute");

		$ObjectJSON->Status = "OK";
		$ObjectJSON->latitude = ($latitude);
		$ObjectJSON->longitude = ($longitude);
		$ObjectJSON->Token = md5($Carid);
		$ObjectJSON->Message = "Succesfully inserted";	

	} else {
		$ObjectJSON->Status = "No hits found";
		$ObjectJSON->Token = md5("NOHITS");
		$ObjectJSON->Message = "There where no hits found in this area";
		
	}


	printJSON($ObjectJSON);

?>