<?php

	require_once("../../../../config.php");
	enableJSON();

	if(isset($_GET['fromuser']) && isset($_GET['touser']) && isset($_GET['content'])) {

		$FromUser = $_GET['fromuser'];
		$ToUser = $_GET['touser'];
		$Content = $_GET['content'];

		$Query = "INSERT INTO comments (fromuser,touser,content) VALUES ('$FromUser', '$ToUser', '$Content')";

		$Result = mysql_query($Query);

		$ObjectJSON->Status = "OK";
		$ObjectJSON->Message = "Comment Added";

	} else {
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Message = "You must give fromuser, touser and content using GET method !";
	}

	printJSON($ObjectJSON);

?>