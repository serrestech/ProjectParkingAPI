<?php

	// Desc : Login user through MySQL Server using GET HTTP Methods
	// Input : User's e-Mail as email, User's Password as password
	// Output : Status, Token, Message

	require_once("../../../../config.php");
	require_once("../auth.php");

	enableJSON();

	if(isset($_GET['email']) && isset($_GET['password'])) {
		$eMail = $_GET['email'];
		$Password = md5($_GET['password']);

		if(isValidMail($eMail)) {
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
				$ObjectJSON->Message = "There is no user with $eMail as eMail !";
			}
		} else {
			$ObjectJSON->Status = "BAD";
			$ObjectJSON->Token = md5("BAD");
			$ObjectJSON->Message = "This is not a valid email !";
		}
	} else {
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Token = md5("BAD");
		$ObjectJSON->Message = "You must give email and password using GET methods !";
	}

	printJSON($ObjectJSON);

?>