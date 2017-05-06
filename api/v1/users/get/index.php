<?php

	require_once("../../../../config.php");
	enableJSON();

	require_once("../auth.php");

	if(isset($_GET['id'])) {
		$Query
	} else {
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Message = "You must give id using GET method !";

	}

	printJSON($ObjectJSON);

?>