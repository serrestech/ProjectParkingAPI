<?php

	require_once("../../../../config.php");
	enableJSON();

	if(isset($_POST['fromuser']) && isset($_POST['touser']) && isset($_POST['content'])) {

		// $Query = "INSERT INTO comments (fromuser,touser,content) VALUES ('$FromUser', '$ToUser', '$Content')";

	} else {
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Message = "You must give fromuser, touser and content using POST method !";
	}

	printJSON($ObjectJSON);

?>