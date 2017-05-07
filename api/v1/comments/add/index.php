<?php

	// Desc : Add Comment from One User to Other through MySQL Server
	// Input : User's Name as username, User's Token as token, Other User's ID ad touser, Comment as content
	// Output : Status, Message

	require_once("../../../../config.php");
	require_once("../../../../api/v1/users/auth.php");

	enableJSON();

	if(isset($_GET['username']) && isset($_GET['token']) && isset($_GET['touser']) && isset($_GET['content'])) {

		$Username = $_GET['username'];
		$Token = $_GET['token'];
		$FromUser = findIDFromUsername($Username);
		$ToUser = $_GET['touser'];
		$Content = $_GET['content'];

		if(isAuthorized($Username, $Token)) {
			$Query = "INSERT INTO comments (fromuser,touser,content) VALUES ('$FromUser', '$ToUser', '$Content')";

			$Result = mysql_query($Query);

			$ObjectJSON->Status = "OK";
			$ObjectJSON->Message = "Comment Added !";
		} else {
			$ObjectJSON->Status = "BAD";
			$ObjectJSON->Message = "You are not authorized !";
		}

	} else {
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Message = "You must give username, token, touser and content using GET method !";
	}

	printJSON($ObjectJSON);

?>