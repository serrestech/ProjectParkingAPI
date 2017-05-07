<?php

	// Desc : Show User's Info through MySQL Server
	// Input : User's ID as id
	// Output : Status, Message, id, username, email, mobile

	require_once("../../../../config.php");
	enableJSON();

	require_once("../auth.php");

	if(isset($_GET['id'])) {
		$ID = $_GET['id'];
		if(isRegisteredID($ID)) {
			$ObjectJSON->Status = "OK";
			$ObjectJSON->Message = "User Found !";

			$Query = "SELECT * FROM users WHERE id='$ID'";

			$Row = mysql_fetch_array(mysql_query($Query));

			$ObjectJSON->ID = $Row['id'];
			$ObjectJSON->Username = $Row['username'];
			$ObjectJSON->eMail = $Row['email'];
			$ObjectJSON->Mobile = $Row['mobile'];

		} else {
			$ObjectJSON->Status = "BAD";
			$ObjectJSON->Message = "There is no user with this id !";
		}
	} else {
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Message = "You must give username using GET method !";
	}

	printJSON($ObjectJSON);

?>