<?php

	require_once("../../../../config.php");
	enableJSON();

	require_once("../auth.php");

	if(isset($_GET['email']) && isset($_GET['password'])) {

		$eMail = $_GET['email'];
		$Password = md5($_GET['password']);

		if (isRegisteredMail($eMail)) {
			$Query = "SELECT * FROM users WHERE email='$eMail' AND password='$Password'";
			
			if(mysql_num_rows(mysql_query($Query)) == 1) {
				$ObjectJSON->Status = "OK";
				$ObjectJSON->Token = md5(findUsernameFromMail($eMail).$Password);
				$ObjectJSON->Message = "Logged In";
			} else {
				$ObjectJSON->Status = "BAD";
				$ObjectJSON->Token = md5("BAD");
				$ObjectJSON->Message = "Wrong password ! Try again !";
			}

		} else {
			$ObjectJSON->Status = "BAD";
			$ObjectJSON->Token = md5("BAD");
			$ObjectJSON->Message = "We can't find user with this email !";
		}

	} else {
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Token = md5("BAD");
		$ObjectJSON->Message = "You must give email and password using GET method !";
		
	}

	printJSON($ObjectJSON);

?>