<?php

	// Desc : Register new user to MySQL Server using GET HTTP Methods
	// Input : User's Username as username, User's e-Mail as email, User's Password as password
	// Output : Status, Token, Message

	require_once("../../../../config.php");
	require_once("../auth.php");

	enableJSON();

	if(isset($_GET['username']) && isset($_GET['email']) && isset($_GET['password'])) {

		$Username = $_GET['username'];
		$eMail = $_GET['email'];
		$Password = md5($_GET['password']);

		if($Username == "" || $eMail == "" || $Password == "") {
			$ObjectJSON->Status = "BAD";
			$ObjectJSON->Token = md5("BAD");
			$ObjectJSON->Message = "You must fill all fields !";
		} else {
			if(isRegisteredUsername($Username) || isRegisteredMail($eMail)) {
				$ObjectJSON->Status = "BAD";
				$ObjectJSON->Token = md5("BAD");
				$ObjectJSON->Message = "This username or email is used ! Use other username and-or email !";
			} else {
				if(isValidUsername($Username)) {
					if(isValidMail($eMail)) {
							$Query = "INSERT INTO users(username,password, email) VALUES ('$Username','$Password','$eMail')";
							$Result = mysql_query($Query);

							$ObjectJSON->Status = "OK";
							$ObjectJSON->Token = md5($Username.$Password);
							$ObjectJSON->Message = "You have successfully registered !";
					} else {
						$ObjectJSON->Status = "BAD";
						$ObjectJSON->Token = md5("BAD");
						$ObjectJSON->Message = "This is not a valid email !";
					}
				} else {
					$ObjectJSON->Status = "BAD";
					$ObjectJSON->Token = md5("BAD");
					$ObjectJSON->Message = "This is not a valid username !";
				}
			}
		}
	} else {
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Token = md5("BAD");
		$ObjectJSON->Message = "You must give username, email and password using GET methods !";
	}

	printJSON($ObjectJSON);
	
?>