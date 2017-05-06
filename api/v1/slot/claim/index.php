 <?php
	
	require_once("../../../../config.php");
	//require_once("");

	enableJSON();

	if(isset($_GET['userid']) && isset($_GET['plate']) ) {

		
		$Userid = $_POST['userid'];
		$Plate = $_POST['plate'];
		$Brand = $_POST['brand'];
		$Model = $_POST['model'];
		





		


		$Query = " ";

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
