 <?php
	
	require_once("../../../../config.php");
	require_once("../../../../api/v1/users/auth.php");
	

	enableJSON();



	if(isset($_GET['token']) && isset($_GET['username']) && isset($_GET['slotid'])) {

		
		
		$Username = $_GET['username'];
		$Token = $_GET['token'];
		$Slotid = $_GET['slotid'];
		
		
		if(isAuthorized($Username,$Token)){
			 $Userid = findIDFromUsername($Username);
			 $Query = "UPDATE slots SET userid = $Userid;";
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