 <?php

 	//Description -> Claims the free parking slot by seting userid in slots table equal to the  id of User that claims it.
 	//Input -> token, username, slotid.
 	//Output ->JSON obj file with status and a message.
	
	require_once("../../../../config.php");
	require_once("../../../../api/v1/users/auth.php");
	

	enableJSON();



	if(isset($_GET['token']) && isset($_GET['username']) && isset($_GET['slotid'])) {

		
		
		$Username = $_GET['username'];
		$Token = $_GET['token'];
		$Slotid = $_GET['slotid'];
		
		
		if(isAuthorized($Username,$Token)){
			 $Userid = findIDFromUsername($Username);
			 $Query = "UPDATE slots SET userid = $Userid, status = 'reserve';";
			 $Result = mysql_query($Query)  or die("Query didnt execute");

		}

		else{
			$ObjectJSON->Status = "BAD";
		
			$ObjectJSON->Message = "Not authorized";

		}




	} else {
		$ObjectJSON->Status = "BAD";
		
		$ObjectJSON->Message = "You must give username, token and slotid";
		
	}

	printJSON($ObjectJSON);
?>