<?php

	require_once("../../../../config.php");
	enableJSON();

	function isRegisteredMail($eMail) {
		$Query = "SELECT * FROM users WHERE email='$eMail'";
		if(mysql_num_rows(mysql_query($Query)) == 1) {
			return true;
		}
	}

	function isRegisteredUsername($Username) {
		$Query = "SELECT * FROM users WHERE username='$Username'";
		if(mysql_num_rows(mysql_query($Query)) == 1) {
			return true;
		}
	}

	if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {

		$Username = $_POST["username"];
		$eMail = $_POST['email'];
		$Password = md5($_POST['password']);

		if(isRegisteredUsername($Username)) {
			$ObjectJSON->Status = "BAD";
			$ObjectJSON->Token = md5("BAD");
			$ObjectJSON->Message = "This username is used ! Use other username !";
		} else if (isRegisteredMail($eMail)) {
			$ObjectJSON->Status = "BAD";
			$ObjectJSON->Token = md5("BAD");
			$ObjectJSON->Message = "This email is used ! Use other email !";
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
		$ObjectJSON->Message = "You must give username, email and password using POST method !";
		
	}

	printJSON($ObjectJSON);

?>