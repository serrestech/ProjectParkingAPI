<?php
	
	require_once("../../../../config.php");
	enableJSON();

	if(isset($_GET['startlat']) && isset($_GET['startlng'])) {

		
		$Latitude = $_GET['latitude'];
		$Longitude = $_GET['longitude'];
		$City = $_GET['city'];
		$Address = $_GET['address'];
		$Startlat = $_GET['startlat'];
		$Startlng = $_GET['startlng'];

		



		


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
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Token = md5("NOHITS");
		$ObjectJSON->Message = "There where no hits found in this area";
		
	}


	printJSON($ObjectJSON);

?>