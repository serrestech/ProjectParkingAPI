<?php
	
	require_once("../../../../config.php");
	enableJSON();

	if(isset($_GET['startlat']) && isset($_GET['startlng']) && isset($_GET['token'])) {

		
		$Token = $_GET['token'];
		$Startlat = $_GET['startlat'];
		$Startlng = $_GET['startlng'];

		



		if(isAuthorized($Token)){




		$Query = "SELECT latitude, longitude,  SQRT(
						POW(69.1 * (latitude - $Startlat), 2)
    				 + 	POW(69.1 * ($Startlng - longitude) * COS(latitude / 57.3), 2)
    					) AS distance
					FROM slots HAVING distance < 25  ORDER BY distance";

		$Result = mysql_query($Query)  or die("Query didnt execute");

		$ObjectJSON->Status = "OK";
		$ObjectJSON->latitude = ($latitude);
		$ObjectJSON->longitude = ($longitude);
		$ObjectJSON->Message = "Succesfully inserted";	

		}

		else{
			echo "User is unauthorized" ;
		}

	} else {
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Message = "There where no hits found in this area";
		
	}


	printJSON($ObjectJSON);

?>