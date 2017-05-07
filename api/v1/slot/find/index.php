<?php
	
	//Description -> Finds free parking slots within the range(distance) submitted on the sql Query.
 	//Input -> token, latitude and longitude of User's target.
 	//Output ->free parking slots.
	
	

	require_once("../../../../config.php");
	require_once("../../../../api/v1/users/auth.php");

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
					FROM slots
					WHERE status = 'free' 
					HAVING distance < 25  
					ORDER BY distance";

			$Result = mysql_query($Query);


			if(mysql_num_rows($Result) == 0) {
				$ObjectJSON->Status = "BAD";
				$ObjectJSON->Message = "We can't find slot !";
			} else {
				$ObjectJSON->Status = "OK";
				$ObjectJSON->Message = "We have found some slots !";
			
				$Count = 0;
				while($Row = mysql_fetch_array($Result)) {
					$ObjectJSON->Slots[$Count]->Longitude = $Row['longitude'];
					$ObjectJSON->Slots[$Count]->Latitude = $Row['latitude'];
					$Count++;
				}
			}
			

		} else {
			$ObjectJSON->Status = "BAD";
			$ObjectJSON->Message = "You are unauthorized !";
		}

	} else {
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Message = "You must give token, startlng, startlat using GET methods !";
		
	}


	printJSON($ObjectJSON);

?>