<?php

	require_once("../../../../config.php");
	enableJSON();

	if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {

		$Username = $_POST["username"];
		$eMail = $_POST['email'];
		$Password = md5($_POST['password']);

		$Query = "INSERT INTO users(username,password, email) VALUES ('$Username','$Password','$eMail')";

		$Result = mysql_query($Query);

		$ObjectJSON->Status = "OK";
		$ObjectJSON->Token = md5($Username.$Password);
		$ObjectJSON->Message = "ANTE GIA";	

	} else {
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Token = md5("BAD");
		$ObjectJSON->Message = "You must give username, email and password using POST method";
		
	}

	printJSON($ObjectJSON);

?>