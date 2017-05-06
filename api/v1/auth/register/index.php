<?php

	require_once("../../../../config.php");
	enableJSON();

	require_once("../auth.php");

	if(isset($_GET['email']) && isset($_GET['username']) && isset($_GET['password'])) {

		$Username = "debuguser";
		$eMail = $_GET['email'];
		$Password = md5($_GET['password']);

		if(isRegisteredUsername($Username) || isRegisteredMail($eMail)) {
			$ObjectJSON->Status = "BAD";
			$ObjectJSON->Token = md5("BAD");
			$ObjectJSON->Message = "This username or email is used ! Use other username and/or email !";
		} else {
			$Query = "INSERT INTO users(username,password, email) VALUES ('$Username','$Password','$eMail')";

			$Result = mysql_query($Query);

			$ObjectJSON->Status = "OK";
			$ObjectJSON->Token = md5($Username.$Password);
			$ObjectJSON->Message = "User registered !";
		}

	} else {
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Token = md5("BAD");
		$ObjectJSON->Message = "You must give email and password using GET method !";
		
	}

	printJSON($ObjectJSON);

?>