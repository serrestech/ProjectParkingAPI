<?php

	// Desc : Show all comments for a user through MySQL Server
	// Input : User's Token as token, User's ID as id
	// Output : Status, Message, Users [id,username,email,mobile]

	require_once("../../../../config.php");
	require_once("../../../../api/v1/users/auth.php");

	enableJSON();



	if(isset($_GET['token']) && isset($_GET['id'])) {
		$Token = $_GET['token'];
		$ID = $_GET['id'];
		
		if(isAuthorized($Token)) {

			$Query = "SELECT * FROM comments WHERE touser='$ID'";

			$Result = mysql_query($Query);

			if(mysql_num_rows($Result) == 0) {
				$ObjectJSON->Status = "BAD";
				$ObjectJSON->Message = "No Comments Found";
			} else {
				$ObjectJSON->Status = "OK";
				$ObjectJSON->Message = "Comments Found";
				$Counter = 0;
				while($Row = mysql_fetch_array($Result)) {
					$ObjectJSON->Comments[$Counter]->FromUser = $Row['fromuser'];
					$ObjectJSON->Comments[$Counter]->ToUser = $Row['touser'];
					$ObjectJSON->Comments[$Counter]->Content = $Row['content'];
					$Counter++;
				}
			}
		} else {
			$ObjectJSON->Status = "BAD";
			$ObjectJSON->Message = "You are not authorized !";
		}
	} else {
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Message = "You must give token and id using GET methods !";
	}

	printJSON($ObjectJSON);

?>